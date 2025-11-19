<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function kegiatan()
    {
        $kegiatans = Kegiatan::with(['siswa'])->ordeBy('tanggal', 'desc')->get();
        return view('admin.kegiatan.kegiatan', compact('kegiatans'));
    }
    public function index()
    {
        $kegiatans = Kegiatan::where('id_siswa', Auth::user()->siswa->id)->orderBy('tanggal', 'desc')->get();
        return view('siswa.kegiatan.index', compact('kegiatans'));
    }
    public function create()
    {
        return view('siswa.kegiatan.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kegiatan' => 'required|string',
            'dokumentasi' => 'required|image|mimes:jpeg,jpg,png',

        ]);

        $gambar = $request->file('dokumentasi')->store('kegiatan', 'public');

        Kegiatan::create([
            'id_siswa' => Auth::user()->siswa->id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'kegiatan' => $request->kegiatan,
            'dokumentasi' => $gambar,
        ]);
        return redirect()->route('siswa.kegiatan.index')->with('success', 'Kegiatan berhasil ditambah');
    }
    public function edit(Kegiatan $kegiatan)
    {
        return view('siswa.kegiatan.edit', compact('kegiatan'));
    }
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kegiatan' => 'required|string',
            'dokumentasi' => 'required|image|mimes:jpeg,jpg,png',

        ]);
        $data = [
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'kegiatan' => $request->kegiatan,
        ];

        if ($request->hasFile('dokumentasi')) {
            if ($kegiatan->dokumentasi && Storage::disk('public')->exists($kegiatan->dokumentasi)) {
                Storage::disk('public')->delete($kegiatan->dokumentasi);
            }
            $data['dokumentasi'] = $request->file('dokumentasi')->store('kegiatan', 'public');
        }

        $kegiatan->update($data);
        return redirect()->route('siswa.kegiatan.index')->with('success', 'Kegiatan berhsil di perbarui');
    }
    
    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->dokumentasi ) {
            Storage::disk('public')->delete($kegiatan->dokumentasi);
        }
        $kegiatan->delete();
        return redirect()->route('siswa.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus');
    }
}
