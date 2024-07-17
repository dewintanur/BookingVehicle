<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Vehicle; 
use App\Models\User; 
use App\Models\Driver;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookingsExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        Log::info('User ' . Auth::user()->name . ' accessed the bookings index.');
        return view('bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        if (Auth::user()->role === 'approver' && $booking->status === 'pending') {
            Log::warning('User ' . Auth::user()->name . ' attempted to access a pending booking: ' . $booking->id);
            abort(403, 'Unauthorized action.');
        }

        Log::info('User ' . Auth::user()->name . ' viewed booking details: ' . $booking->id);
        return view('bookings.show', compact('booking'));
    }

    public function create()
    {
        $vehicles = Vehicle::all(); 
        $approvers = User::where('role', 'approver')->get(); 
        $drivers = Driver::all(); 
        Log::info('User ' . Auth::user()->name . ' accessed the create booking page.');
        return view('bookings.create', compact('vehicles', 'approvers', 'drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:users,id',
            'approver_id' => 'required|exists:users,id',
        ]);

        $booking = Booking::create([
            'user_id' => Auth::id(), 
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'approver_id' => $request->approver_id,
            'status' => 'pending',
        ]);

        Log::info('User ' . Auth::user()->name . ' created a new booking: ' . $booking->id);
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function approve($id)
    {
        $booking = Booking::findOrFail($id);

        if (Auth::user()->role !== 'approver' || $booking->approver_id !== Auth::id()) {
            Log::warning('User ' . Auth::user()->name . ' attempted to approve booking: ' . $booking->id);
            abort(403, 'Unauthorized action.');
        }

        if ($booking->status === 'pending') {
            $booking->status = 'approved';
            $booking->approved_at = now();
            $booking->save();

            Log::info('User ' . Auth::user()->name . ' approved booking: ' . $booking->id);
            return redirect()->route('bookings.index')->with('success', 'Booking approved successfully.');
        } elseif ($booking->status === 'approved') {
            $booking->status = 'final_approved';
            $booking->final_approved_at = now();
            $booking->save();

            Log::info('User ' . Auth::user()->name . ' finally approved booking: ' . $booking->id);
            return redirect()->route('bookings.index')->with('success', 'Booking finally approved successfully.');
        }

        return redirect()->route('bookings.index')->with('error', 'Invalid booking status.');
    }

    public function reject($id)
    {
        $booking = Booking::findOrFail($id);

        if (Auth::user()->role !== 'approver' || $booking->approver_id !== Auth::id()) {
            Log::warning('User ' . Auth::user()->name . ' attempted to reject booking: ' . $booking->id);
            abort(403, 'Unauthorized action.');
        }

        $booking->status = 'rejected';
        $booking->rejected_at = now();
        $booking->save();

        Log::info('User ' . Auth::user()->name . ' rejected booking: ' . $booking->id);
        return redirect()->route('bookings.index')->with('success', 'Booking rejected successfully.');
    }

    public function finalApprove($id)
    {
        $booking = Booking::findOrFail($id);

        if (Auth::user()->role !== 'approver' || $booking->approver_id !== Auth::id()) {
            Log::warning('User ' . Auth::user()->name . ' attempted to finally approve booking: ' . $booking->id);
            abort(403, 'Unauthorized action.');
        }

        $booking->status = 'final_approved';
        $booking->final_approved_at = now();
        $booking->save();

        Log::info('User ' . Auth::user()->name . ' finally approved booking: ' . $booking->id);
        return redirect()->route('bookings.index')->with('success', 'Booking finally approved successfully.');
    }

    public function export()
    {
        Log::info('User ' . Auth::user()->name . ' exported bookings to Excel.');
        return Excel::download(new BookingsExport, 'bookings.xlsx');
    }
}
