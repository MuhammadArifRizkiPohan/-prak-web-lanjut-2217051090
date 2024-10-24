<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan formulir pembuatan pengguna
    public function create() 
    { 
        return view('create_user'); // Pastikan Anda memiliki view 'create_user.blade.php'
    }

    // Menyimpan data pengguna
    public function store(Request $request) 
    { 
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'npm' => 'required|string|max:20',
        ]);

        // Ambil data dari request
        $data = [ 
            'nama' => $request->input('nama'), 
            'kelas' => $request->input('kelas'), 
            'npm' => $request->input('npm'), 
        ];

        // Kirimkan data ke dalam view profil
        return view('profile', $data); 
    }

    // Menampilkan profil pengguna
    public function profile() 
    {
        // Jika Anda ingin menampilkan data profil dari session
        return view('profile', [
            'nama' => session('nama'),
            'kelas' => session('kelas'),
            'npm' => session('npm'),
        ]);
    }
}