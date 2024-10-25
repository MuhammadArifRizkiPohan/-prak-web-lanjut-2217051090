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
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id', // Pastikan menggunakan kelas_id
        ]);

        // Simpan pengguna ke dalam database menggunakan $this
        $user = $this->userModel::create($validatedData); 
        
        return redirect()->to('/users'); 

        

       
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