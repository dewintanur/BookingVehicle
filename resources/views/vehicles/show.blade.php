<!-- resources/views/vehicles/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Vehicle Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $vehicle->name }}</h5>
            <p class="card-text"><strong>Type:</strong> {{ $vehicle->type }}</p>
            <p class="card-text"><strong>Company Owned:</strong> {{ $vehicle->is_company_owned ? 'Yes' : 'No' }}</p>
            <p class="card-text"><strong>BBM (Fuel Consumption):</strong> {{ $vehicle->BBM }}</p>
            <p class="card-text"><strong>Service Schedule:</strong> {{ $vehicle->service_schedule }}</p>
            <h5>Usage History:</h5>
            <ul>
                @foreach($vehicle->bookings()->where('status', 'final_approved')->get() as $booking)
                    <li>
                        Used on {{ $booking->usage_date }} by {{ $booking->driver->name }}
                        - Final Approved
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="card-footer">
            <a href="{{ route('vehicles.index') }}" class="btn btn-primary">Back to Vehicles</a>
            <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-success">Edit</a>
            <!-- Link untuk edit kendaraan -->
        </div>
    </div>
</div>
@endsection
