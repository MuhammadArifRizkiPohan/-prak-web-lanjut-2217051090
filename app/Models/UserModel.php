<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    // Tentukan tabel yang akan digunakan
    protected $table = 'user';  // Menggunakan tabel 'users' di database

    // Guarded digunakan untuk menghindari mass assignment pada kolom tertentu
    protected $guarded = ['id'];

    // Definisikan relasi belongsTo ke model Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    public function getUser(){ 
        return $this->join('kelas', 'kelas.id', '=', 
        'user.kelas_id')->select('user.*', 'kelas.nama_kelas as 
        nama_kelas')->get(); 
        } 
}
