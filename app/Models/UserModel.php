<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    // Tentukan tabel yang akan digunakan
    protected $table = 'users'; // Pastikan nama tabel sesuai dengan yang ada di database

    // Guarded digunakan untuk menghindari mass assignment pada kolom tertentu
    protected $guarded = ['id'];

    // Definisikan relasi belongsTo ke model Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Definisikan relasi many-to-many ke model Jurusan
    public function jurusans()
    {
        return $this->belongsToMany(Jurusan::class, 'user_jurusan');
    }

    // Mendapatkan user dengan informasi kelas
    public function getUser ()
    {
        return $this->join('kelas', 'kelas.id', '=', 'users.kelas_id')
                    ->select('users.*', 'kelas.nama_kelas as nama_kelas')
                    ->get();
    }
    public function jurusan()
{
    return $this->belongsToMany(Jurusan::class, 'user_jurusan');
}
}