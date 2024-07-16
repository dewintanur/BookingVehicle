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
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
