<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas; 
use App\Models\User; 
use App\Models\UserModel;
use Illuminate\Support\Facades\Storage;

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
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Meng-handle upload foto
    $fotoPath = null; // Inisialisasi fotoPath
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        // Menyimpan file foto di folder 'uploads/img' di storage
        $fotoPath = $foto->store('uploads/img', 'public'); // Menggunakan storage
    }

    // Menyimpan data ke database termasuk path foto
    $this->userModel->create([
        'nama' => $request->input('nama'),
        'npm' => $request->input('npm'),
        'kelas_id' => $request->input('kelas_id'),
        'foto' => $fotoPath, // Menyimpan path foto
    ]);

    // Redirect ke halaman daftar pengguna setelah berhasil menyimpan
    return redirect()->route('users.index')->with('success', 'User  berhasil ditambahkan');
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
    public function edit($id)
{
    $user = $this->userModel->findOrFail($id);
    $kelas = Kelas::all(); // Ambil semua kelas untuk dropdown

    return view('users.edit', compact('user', 'kelas'));
}

public function update(Request $request, $id)
{
    $user = $this->userModel->findOrFail($id);

    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'npm' => 'required|string|max:255',
        'kelas_id' => 'required|exists:kelas,id',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto, max 2MB
    ]);

    // Update data pengguna
    $user->nama = $request->nama;
    $user->npm = $request->npm;
    $user->kelas_id = $request->kelas_id;

    // Cek apakah ada file foto yang diupload
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($user->foto) {
            Storage::delete('public/' . $user->foto);
        }

        // Simpan foto baru
        $path = $request->file('foto')->store('uploads/img', 'public');
        $user->foto = $path; // Simpan path foto di database
    }

    $user->save(); // Simpan perubahan ke database

    return redirect()->route('users.index')->with('success', 'User  berhasil diperbarui');
}
    public function destroy($id)
{
    $user = $this->userModel->findOrFail($id);

    // Hapus foto jika ada
    if ($user->foto) {
        Storage::disk('public')->delete($user->foto);
    }

    $user->delete();

    return redirect()->route('users.index')->with('success', 'User  berhasil dihapus');
    }   
}