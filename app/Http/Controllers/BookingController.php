<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Vehicle; // Import model Vehicle
use App\Models\User; // Jika dibutuhkan untuk select approver
use App\Models\Driver;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookingsExport; // Pastikan Anda membuat Export class terlebih dahulu

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
        $drivers = Driver::all(); // Mendapatkan semua driver dari model Driver
        return view('bookings.create', compact('vehicles', 'approvers', 'drivers'));
    }

    public function store(Request $request)
{
    $request->validate([
        'vehicle_id' => 'required|exists:vehicles,id',
        'driver_id' => 'required|exists:users,id',
        'approver_id' => 'required|exists:users,id',
    ]);

    Booking::create([
        'user_id' => Auth::id(), // Jika ingin mencatat user yang melakukan pemesanan
        'vehicle_id' => $request->vehicle_id,
        'driver_id' => $request->driver_id,
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

        if ($booking->status === 'pending') {
            $booking->status = 'approved';
            $booking->approved_at = now();
            $booking->save();

            return redirect()->route('bookings.index')->with('success', 'Booking approved successfully.');
        } elseif ($booking->status === 'approved') {
            $booking->status = 'final_approved';
            $booking->final_approved_at = now();
            $booking->save();

            return redirect()->route('bookings.index')->with('success', 'Booking finally approved successfully.');
        }

        return redirect()->route('bookings.index')->with('error', 'Invalid booking status.');
    }

    public function reject($id)
    {
        $booking = Booking::findOrFail($id);

        if (Auth::user()->role !== 'approver' || $booking->approver_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->status = 'rejected';
        $booking->rejected_at = now();
        $booking->save();

        return redirect()->route('bookings.index')->with('success', 'Booking rejected successfully.');
    }

    public function finalApprove($id)
    {
        $booking = Booking::findOrFail($id);
    
        if (Auth::user()->role !== 'approver' || $booking->approver_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    
        $booking->status = 'final_approved';
        $booking->final_approved_at = now(); // Atur waktu final approval
        $booking->save();
    
        return redirect()->route('bookings.index')->with('success', 'Booking finally approved successfully.');
    }
    public function export()
{
    return Excel::download(new BookingsExport, 'bookings.xlsx');
}
}