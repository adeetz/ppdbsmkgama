<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers'; // Pastikan nama tabel sesuai
    protected $fillable = ['nama_lengkap', 'no_hp', 'asal_sekolah', 'tgl_daftar']; // Kolom yang bisa diisi
}

