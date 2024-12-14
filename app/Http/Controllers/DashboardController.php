<?php
// DashboardController.php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua kendaraan
        $vehicles = Vehicle::all();

        // Siapkan data untuk chart
        $chartData = [];
        foreach ($vehicles as $vehicle) {
            $chartData[] = [
                'name' => $vehicle->name,
                'usage_history' => $vehicle->usage_history,
            ];
        }

        // Kirim data ke view dashboard
        return view('dashboard', compact('chartData'));
    }
}

