<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:people,goods',
            'is_company_owned' => 'required|boolean',
        ]);

        Vehicle::create($request->only('name', 'type', 'is_company_owned'));

        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
    }
}
