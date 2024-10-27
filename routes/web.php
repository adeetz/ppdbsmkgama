<?php

use App\Livewire\CreateCustomer;
use App\Livewire\DataSiswa;
use App\Livewire\EditSiswa;
use App\Livewire\Register;
use App\Livewire\Users;
use App\Livewire\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Dapat Diakses Tanpa Login)
|--------------------------------------------------------------------------
*/

// Ubah redirect dari home
Route::get('/', function () {
    return redirect('/login'); // Ubah ke login sebagai default
})->middleware('guest');

// Route untuk login
Route::get('/login', Login::class)
    ->name('login')
    ->middleware('guest');

// Route untuk pendaftaran siswa (dapat diakses publik)
Route::get('/daftarsiswa', CreateCustomer::class)
    ->name('daftarsiswa')
    ->middleware('guest');

/*
|--------------------------------------------------------------------------
| Protected Routes (Memerlukan Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Dashboard Route (tambahkan ini)
    Route::get('/dashboard', function() {
        return redirect()->route('datasiswa');
    })->name('dashboard');
    
    // Data Management Routes
    Route::get('/datasiswa', DataSiswa::class)->name('datasiswa');
    Route::get('/datasiswa/{customer}/edit', EditSiswa::class)->name('editSiswa');
    
    // User Management Routes
    Route::get('/users', Users::class)->name('users');
    Route::get('/users/create', Register::class)->name('users.create');

    // Logout Route
    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login')->with('success', 'Berhasil logout!');
    })->name('logout');
});

/*
|--------------------------------------------------------------------------
| Fallback Route
|--------------------------------------------------------------------------
*/

// Ubah fallback route
Route::fallback(function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});