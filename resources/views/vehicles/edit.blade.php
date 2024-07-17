@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Vehicle</h1>
    <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $vehicle->name }}" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-control" id="type" name="type" required>
                <option value="people" {{ $vehicle->type === 'people' ? 'selected' : '' }}>People</option>
                <option value="goods" {{ $vehicle->type === 'goods' ? 'selected' : '' }}>Goods</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="is_company_owned" class="form-label">Company Owned</label>
            <select class="form-control" id="is_company_owned" name="is_company_owned" required>
                <option value="1" {{ $vehicle->is_company_owned ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$vehicle->is_company_owned ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="BBM" class="form-label">BBM (Fuel Consumption)</label>
            <input type="text" class="form-control" id="BBM" name="BBM" value="{{ $vehicle->BBM }}">
        </div>
        <div class="mb-3">
            <label for="service_schedule" class="form-label">Service Schedule</label>
            <input type="date" class="form-control" id="service_schedule" name="service_schedule" value="{{ $vehicle->service_schedule }}">
        </div>

       

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
