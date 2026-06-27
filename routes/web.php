<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookingController::class, 'index'])->name('home');
Route::get('/book-appointment', [BookingController::class, 'create'])->name('booking.create');
Route::post('/book-appointment', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking-success', [BookingController::class, 'success'])->name('booking.success');

// Redirect admin to Filament
Route::get('/admin', function () {
    return redirect('/admin/login');
});
