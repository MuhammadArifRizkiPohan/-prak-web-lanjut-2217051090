<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'kelas'; // Tambahkan titik koma di akhir

    // Relasi ke model User
    public function users() 
    {
        return $this->hasMany(User::class, 'kelas_id'); // Pastikan menggunakan User, bukan UserModel
    }

    // Fungsi untuk mendapatkan semua kelas
    public function getKelas() 
    { 
        return $this->all(); 
    }
}