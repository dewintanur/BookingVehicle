@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Booking</h1>
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="vehicle_id" class="form-label">Vehicle</label>
            <select class="form-control" id="vehicle_id" name="vehicle_id" required>
                @foreach($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="approver_id" class="form-label">Approver</label>
            <select class="form-control" id="approver_id" name="approver_id" required>
                @foreach($approvers as $approver)
                <option value="{{ $approver->id }}">{{ $approver->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
