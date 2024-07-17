<!-- resources/views/vehicles/add-usage.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Usage History for {{ $vehicle->name }}</h1>
    <form action="{{ route('vehicles.add-usage', $vehicle->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="mb-3">
            <label for="distance" class="form-label">Distance (in km)</label>
            <input type="number" class="form-control" id="distance" name="distance" required>
        </div>
        <div class="mb-3">
            <label for="purpose" class="form-label">Purpose</label>
            <textarea class="form-control" id="purpose" name="purpose" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
@endsection
