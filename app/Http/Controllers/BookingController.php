<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Vehicle; // Import model Vehicle
use App\Models\User; // Jika dibutuhkan untuk select approver
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        // Admin dapat melihat semua booking
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        // Approver hanya dapat melihat detail booking yang sedang di-approve
        if (Auth::user()->role === 'approver' && $booking->status === 'pending') {
            abort(403, 'Unauthorized action.');
        }
        $bookings = Booking::all();

        return view('bookings.show', compact('bookings'));
    }

    public function create()
    {
        // Admin bisa membuat booking baru
        $vehicles = Vehicle::all(); // Mendapatkan semua data vehicle
        $approvers = User::where('role', 'approver')->get(); // Mendapatkan semua user dengan role approver

        return view('bookings.create', compact('vehicles', 'approvers'));
    }

    public function store(Request $request)
    {
        // Validasi request untuk menyimpan booking baru
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'approver_id' => 'required|exists:users,id',
        ]);

        // Buat booking baru berdasarkan input user
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
        // Approver bisa menyetujui booking
        $booking = Booking::findOrFail($id);

        // Validasi bahwa user yang sedang login adalah approver yang tepat
        if (Auth::user()->role !== 'approver' || $booking->approver_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Update status booking menjadi approved
        $booking->status = 'approved';
        $booking->approved_at = now();
        $booking->save();

        return redirect()->route('bookings.show')->with('success', 'Booking approved successfully.');
    }
}
