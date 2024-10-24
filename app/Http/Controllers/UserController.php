<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas; 
use App\Models\User; 
use App\Models\UserModel;

class UserController extends Controller
{
    public function create() 
    { 
        return view('create_user', [
            'kelas' => Kelas::all(),
        ]); 
    }

    // Menyimpan data pengguna
    public function store(Request $request) 
    { 
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id', // Pastikan menggunakan kelas_id
        ]);

        // Simpan pengguna ke dalam database
        $user = UserModel::create($validatedData); // Pastikan Anda menggunakan model User

        // Mengambil data kelas setelah disimpan
        $user->load('kelas');

        // Menyimpan data pengguna dalam session
        session([
            'nama' => $user->nama, 
            'npm' => $user->npm, 
            'kelas' => $user->kelas->nama_kelas ?? 'Kelas tidak ditemukan',
        ]);

        return redirect()->route('profile'); // Redirect ke route profile
    }

    // Menampilkan profil pengguna
    public function profile() 
    {
        return view('profile', [
            'nama' => session('nama'),
            'npm' => session('npm'),
            'kelas' => session('kelas'),
        ]);
    }
}