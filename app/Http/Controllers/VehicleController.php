<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        Log::info('User ' . auth()->user()->name . ' accessed the vehicles index.');
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        Log::info('User ' . auth()->user()->name . ' accessed the create vehicle page.');
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:people,goods',
            'is_company_owned' => 'required|boolean',
            'BBM' => 'nullable|numeric|min:0',
            'service_schedule' => 'nullable|date',
        ]);

        $vehicle = Vehicle::create($request->only('name', 'type', 'is_company_owned', 'BBM', 'service_schedule'));
        Log::info('User ' . auth()->user()->name . ' created a new vehicle: ' . $vehicle->id);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        Log::info('User ' . auth()->user()->name . ' accessed the edit vehicle page for vehicle: ' . $vehicle->id);
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:people,goods',
            'is_company_owned' => 'required|boolean',
        ]);

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($request->only('name', 'type', 'is_company_owned', 'BBM', 'service_schedule', 'usage_history'));
        Log::info('User ' . auth()->user()->name . ' updated vehicle: ' . $vehicle->id);

        return redirect()->route('vehicles.show', $vehicle->id)->with('success', 'Vehicle updated successfully.');
    }

    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        Log::info('User ' . auth()->user()->name . ' viewed vehicle details: ' . $vehicle->id);
        return view('vehicles.show', compact('vehicle'));
    }
}
