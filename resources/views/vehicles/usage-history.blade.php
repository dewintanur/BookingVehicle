<!-- resources/views/vehicles/usage-history.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Usage History for {{ $vehicle->name }}</h1>
    <a href="{{ route('vehicles.add-usage', $vehicle->id) }}" class="btn btn-primary mb-3">Add Usage</a>
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Distance (km)</th>
                <th>Purpose</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usageHistory as $history)
            <tr>
                <td>{{ $history->date }}</td>
                <td>{{ $history->distance }}</td>
                <td>{{ $history->purpose }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
