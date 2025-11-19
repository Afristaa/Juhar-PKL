<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dudi;


class DudiController extends Controller
{
    public function index()  {
        $dudis = Dudi::all();
        return view('admin.dudi.index', compact('dudis')); 
    }
    public function create()  {
        return view('admin.dudi.create');
        
    }
    public function store(Request $request)  {
        $request->validate([
            'nama_dudi' => 'required|unique:dudis,nama_dudi',
            'bidang_usaha' => 'required',
            'alamat' => 'required',
            'direktur_dudi' => 'required',
            'pembimbing_dudi' => 'required',
            'kontak' => 'required',
        ]);
        Dudi::create([
            'nama_dudi' => $request->nama_dudi,
            'bidang_usaha' => $request->bidang_usaha,
            'alamat' => $request->alamat,
            'direktur_dudi' => $request->direktur_dudi,
            'pembimbing_dudi' => $request->pembimbing_dudi,
            'kontak' => $request->kontak,
        ]);

        return redirect()->route('admin.dudi.index')->with('success', 'Dudi berhasil ditambahkan.');

        
    }
    public function edit(Dudi $dudi)  {
        return view('admin.dudi.edit', compact('dudi'));

        
    }
    public function update(Request $request, Dudi $dudi) {
        $request->validate([
            'nama_dudi' => 'required|unique:dudis,nama_dudi,' . $dudi->id,
            'bidang_usaha' => 'required',
            'alamat' => 'required',
            'direktur_dudi' => 'required',
            'pembimbing_dudi' => 'required',
            'kontak' => 'required',

        ]);
        $dudi->update([
            'nama_dudi' => $request->nama_dudi,
            'bidang_usaha' => $request->bidang_usaha,
            'alamat' => $request->alamat,
            'direktur_dudi' => $request->direktur_dudi,
            'pembimbing_dudi' => $request->pembimbing_dudi,
            'kontak' => $request->kontak,
        ]);
         return redirect()->route('admin.dudi.index')->with('success', 'Dudi berhasil diupdate.');
        
    }
    public function destroy(Dudi $dudi)   {
         if ($dudi->siswas()->count() > 0) {
            return redirect()->route('admin.dudi.index')->with('error', 'dudi tidak bisa dihapus karena masih memiliki siswa.');
        }
        $dudi->delete();
        return redirect()->route('admin.dudi.index')->with('success', 'Dudi berhasil dihapus.');
        
    }
}
