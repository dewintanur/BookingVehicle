@extends('layouts.app')

@section('content')
    <h1>Create Booking</h1>
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="vehicle_id">Vehicle</label>
            <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="approver_id">Approver</label>
            <select name="approver_id" id="approver_id" class="form-control" required>
                @foreach($approvers as $approver)
                    <option value="{{ $approver->id }}">{{ $approver->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Booking</button>
    </form>
@endsection
