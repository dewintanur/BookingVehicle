@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Vehicles</h1>
    <a href="{{ route('vehicles.create') }}" class="btn btn-primary">Create Vehicle</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Company Owned</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehicles as $vehicle)
            <tr>
                <td>{{ $vehicle->id }}</td>
                <td>{{ $vehicle->name }}</td>
                <td>{{ $vehicle->type }}</td>
                <td>{{ $vehicle->is_company_owned ? 'Yes' : 'No' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
