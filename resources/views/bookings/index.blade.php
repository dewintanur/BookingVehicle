@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bookings</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(Auth::user()->role === 'admin')
            <a href="{{ route('bookings.create') }}" class="btn btn-primary">Create Booking</a>
            <a href="{{ route('bookings.export') }}" class="btn btn-success">Export to Excel</a>

        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Vehicle</th>
                    <th>User</th>
                    <th>Approver</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->vehicle->name }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->approver->name }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>
                            @if(Auth::user()->role === 'approver' && $booking->status === 'pending' && $booking->approver_id === Auth::id())
                                <form action="{{ route('bookings.approve', $booking->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                            @endif

                            @if(Auth::user()->role === 'approver' && $booking->status === 'approved' && $booking->approver_id === Auth::id())
                                <form action="{{ route('bookings.final_approve', $booking->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Final Approve</button>
                                </form>
                            @endif

                            @if(Auth::user()->role === 'approver' && $booking->status === 'pending' && $booking->approver_id === Auth::id())
                                <form action="{{ route('bookings.reject', $booking->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Reject</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
