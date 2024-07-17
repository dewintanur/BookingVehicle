<!-- resources/views/vehicles/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Vehicle</h1>
    <form action="{{ route('vehicles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-control" id="type" name="type" required>
                <option value="people">People</option>
                <option value="goods">Goods</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="is_company_owned" class="form-label">Company Owned</label>
            <select class="form-control" id="is_company_owned" name="is_company_owned" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="BBM" class="form-label">Fuel Consumption (BBM)</label>
            <input type="number" class="form-control" id="BBM" name="BBM">
        </div>
        <div class="mb-3">
            <label for="service_schedule" class="form-label">Service Schedule</label>
            <input type="date" class="form-control" id="service_schedule" name="service_schedule">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
