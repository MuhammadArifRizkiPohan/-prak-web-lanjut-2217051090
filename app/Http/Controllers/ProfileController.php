<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Menambahkan parameter $nama, $kelas, dan $npm
    public function profile($nama = "", $kelas = "", $npm = "") 
    { 
        // Menggunakan parameter untuk mengisi data
        $data = [ 
            'nama' => $nama, 
            'kelas' => $kelas, 
            'npm' => $npm,
        ];

        // Mengirim data ke view
        return view('profile', $data); 
    }
}
