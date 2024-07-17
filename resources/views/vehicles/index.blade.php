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
                <th>Usage History</th>
                <th>Actions</th> <!-- Tambahkan kolom aksi -->
            </tr>
        </thead>
        <tbody>
            @foreach($vehicles as $vehicle)
            <tr>
                <td>{{ $vehicle->id }}</td>
                <td>{{ $vehicle->name }}</td>
                <td>{{ $vehicle->type }}</td>
                <td>{{ $vehicle->is_company_owned ? 'Yes' : 'No' }}</td>
                <td>{{ $vehicle->usage_history }}</td>

                
                <td>
                    <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <!-- Tambahkan link untuk detail dan edit -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
