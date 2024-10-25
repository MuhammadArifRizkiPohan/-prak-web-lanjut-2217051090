<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas; 
use App\Models\User; 
use App\Models\UserModel;

class UserController extends Controller
{
    // Mendeklarasikan properti publik untuk model
    public $userModel; 
    public $kelasModel; 

    // Konstruktor untuk menginisialisasi model
    public function __construct() 
    { 
        $this->userModel = new UserModel(); 
        $this->kelasModel = new Kelas(); 
    }
    public function index() 
    { 
        // Mengambil semua pengguna beserta relasi kelas
        $users = $this->userModel::with('kelas')->get(); 
    
        // Menyiapkan data untuk dikirim ke view
        $data = [ 
            'title' => 'List User', // Judul yang sesuai
            'users' => $users, // Mengirimkan data pengguna
        ]; 
    
        // Mengembalikan view dengan data
        return view('list_user', $data); 
    }

    // Menampilkan form untuk membuat pengguna baru
    public function create() 
    { 
        // Mengambil semua kelas dari database menggunakan $this
        $kelas = $this->kelasModel::all(); // Ambil semua kelas
        $data = [ 
            'title' => 'Create User', // Tambahkan judul halaman
            'kelas' => $kelas, 
        ]; 
        return view('create_user', $data); 
    }

    // Menyimpan data pengguna
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelas_id' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk foto
        ]);
    
        // Meng-handle upload foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            // Menyimpan file foto di folder 'images' di storage
            $fotoPath = $foto->store('images', 'public'); // Menggunakan storage
        } else {
            $fotoPath = null; // Jika tidak ada file yang diupload
        }
    
        // Menyimpan data ke database termasuk path foto
        $this->userModel->create([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id'),
            'foto' => $fotoPath, // Menyimpan path foto
        ]);
    
        return redirect()->to('/user')->with('success', 'User  berhasil ditambahkan');
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