@extends('layouts.app')

@section('content')
    <h1>Bookings</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
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
                        @if(Auth::user()->role === 'approver' && $booking->status === 'pending')
                            <form action="{{ route('bookings.approve', $booking->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
