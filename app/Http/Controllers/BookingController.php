<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('vehicle', 'user', 'approver')->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        $approvers = User::where('role', 'approver')->get();
        return view('bookings.create', compact('vehicles', 'approvers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'approver_id' => 'required|exists:users,id',
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $request->vehicle_id,
            'approver_id' => $request->approver_id,
            'status' => 'pending',
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function approve($id)
    {
        $booking = Booking::findOrFail($id);

        if (Auth::user()->role !== 'approver' || $booking->approver_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->status = 'approved';
        $booking->approved_at = now();
        $booking->save();

        return redirect()->route('bookings.index')->with('success', 'Booking approved successfully.');
    }
}
