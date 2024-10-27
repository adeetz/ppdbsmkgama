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

// Redirect dari home ke halaman daftar siswa
Route::get('/', function () {
    return redirect('/daftarsiswa');
});

// Route untuk pendaftaran siswa (dapat diakses publik)
Route::get('/daftarsiswa', CreateCustomer::class)->name('daftarsiswa');

// Route untuk login
Route::get('/login', Login::class)
    ->name('login')
    ->middleware('guest');

/*
|--------------------------------------------------------------------------
| Protected Routes (Memerlukan Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
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

Route::fallback(function () {
    return redirect('/daftarsiswa');
});