<?php

use App\Livewire\CreateCustomer;
use App\Livewire\DataSiswa;
use App\Livewire\EditSiswa;
use App\Livewire\Register;
use App\Livewire\Users;
use App\Livewire\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Redirect halaman '/' ke '/daftarsiswa'
// Tempatkan ini di atas semua middleware untuk memastikan pengalihan terjadi
Route::get('/', function () {
    return redirect('/daftarsiswa'); // Arahkan ke /daftarsiswa
});

// Rute untuk pendaftaran siswa baru (sebagai pengganti halaman login)
Route::get('/daftarsiswa', CreateCustomer::class)->name('daftarsiswa');

// Middleware 'guest': hanya pengguna yang belum login bisa mengakses halaman ini
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});

// Middleware 'auth': halaman-halaman yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    // Rute untuk menampilkan data siswa
    Route::get('/datasiswa', DataSiswa::class)->name('datasiswa');

    // Rute untuk mengedit data siswa
    Route::get('/datasiswa/{customer}/edit', EditSiswa::class)->name('editSiswa');

    // Rute untuk halaman pendaftaran
    Route::get('/register', Register::class)->name('register');

    // Rute untuk pengguna
    Route::get('/users', Users::class)->name('users');

    // Rute untuk logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/daftarsiswa'); // Pengalihan setelah logout ke halaman daftar siswa
    })->name('logout');

    // Redirect ke /datasiswa setelah login
    Route::get('/home', function () {
        return redirect('/datasiswa');
    })->name('home'); // Nama rute bisa diubah sesuai kebutuhan
});
