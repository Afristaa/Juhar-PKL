<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Dudi;
use App\Models\Kegiatan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalKelas = Kelas::count();
            
        if ($user->role === 'admin') {
            $totalDudi = Dudi::count();
            $totalPembimbing = User::where('role', 'pembimbing')->count();
            $totalSiswa = Siswa::count();
            return view('admin.dashboard', compact('user', 'totalKelas', 'totalDudi', 'totalPembimbing', 'totalSiswa'));

        } elseif ($user->role === 'pembimbing') {
            $totalSiswa = Siswa::where('id_pembimbing', Auth::user()->id)->count();
            $totalDudi = Siswa::where('id_pembimbing', Auth::user()->id)->distinct('id_dudi')->count();
            return view('pembimbing.dashboard', compact('user', 'totalSiswa', 'totalDudi'));
            
        } elseif ($user->role === 'siswa') { 
            $totalKegiatan = Kegiatan::where('id_siswa', Auth::user()->siswa->id)->count();
            $totalAbsensi = Absensi::where('id_siswa', Auth::user()->siswa->id)->count(); 
            return view('siswa.dashboard', compact('user', 'totalKegiatan', 'totalAbsensi'));
        } else {
            abort(403, 'Role pengguna tidak dikenal.');
        }
    }
}
