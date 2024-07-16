<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\VehicleController;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Rute untuk admin
    Route::middleware([CheckRole::class . ':admin'])->group(function () {
        Route::resource('vehicles', VehicleController::class);
        Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
        Route::get('bookings/create', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store');
    });

    // Rute untuk approver
    Route::middleware([CheckRole::class . ':approver'])->group(function () {
        Route::get('booking', [BookingController::class, 'show'])->name('bookings.show');
        Route::post('bookings/{booking}/approve', [BookingController::class, 'approve'])->name('bookings.approve'); // Menambahkan route untuk approve booking

    });
});

require __DIR__.'/auth.php';
