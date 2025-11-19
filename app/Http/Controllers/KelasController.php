<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;

class KelasController extends Controller
{
    /**
     * Menampilkan semua data kelas.
     */
    public function index()
    {
        $kelas = Kelas::all();
        return view('admin.kelas.index', compact('kelas'));
    }
    public function create() {
        return view('admin.kelas.create');
        
    }
    public function store(Request $request)  { //  Store Tambah Kelas
        $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
        
    }
    public function edit(Kelas $kelas)  {
        return view('admin.kelas.edit', compact('kelas'));

        
    }
    public function update(Request $request, Kelas $kelas) {
        $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas,' . $kelas->id, // unique kecuali dirinya sendiri, jadi kalau kelasnya punya siswa itu maka tidak boleh di gunakan oleh siswa lain

        ]);
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
        ]);
         return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diupdate.');
        
    }
    public function destroy(Kelas $kelas)   {

        if ($kelas->siswas()->count() > 0) {
            return redirect()->route('admin.kelas.index')->with('error', 'kelas tidak bisa dihapus karena masih memiliki siswa.');
        }
        $kelas->delete();
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
        
    }
    
}
