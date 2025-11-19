<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

class AbsensiController extends Controller
{
    public function absensi()
    {
        // Ambil data siswa absensi dari siswa yang login, ini di admin
        $absensis = Absensi::with(['siswa'])->orderBy('tanggal', 'desc')->get();
        return view('admin.absensi.absensi', compact('absensis'));
    }

    public function index()
    {
        // Ambil data siswa absensi dari siswa yang login
        $absensis = Absensi::where('id_siswa', Auth::user()->siswa->id)->orderBy('tanggal', 'desc')->get();
        return view('siswa.absensi.index', compact('absensis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'status'     => 'required',
            'keterangan' => 'required_if:status,izin,sakit,libur'
        ]);

        // Ambil tanggal hari ini
        $today = Carbon::today();

        // Cegah absen 2x dalam 1 hari
        if (Absensi::where('id_siswa', Auth::user()->siswa->id)->where('tanggal', $today)->exists()) {
            return back()->with('error', 'Siswa sudah absen hari ini.');
        }

        // Cek absen terakhir 
        $lastAbsensi = Absensi::where('id_siswa', Auth::user()->siswa->id)
            ->orderBy('tanggal', 'desc')
            ->first();

        // Isi otomatis ALPA untuk hari bolong (skip weekend)
        if ($lastAbsensi) {
            // Mulai dari H+1
            $nextDate = Carbon::parse($lastAbsensi->tanggal)->addDay();
        
        // selama < hari ini (tanggal terakhir absen)
            while ($nextDate->lt($today)) { // tanggal setelah terakhir absen

                if (!in_array($nextDate->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                    Absensi::create([
                        'id_siswa'   => Auth::user()->siswa->id,
                        'tanggal'    => $nextDate->toDateString(),
                        'status'     => 'alpha',
                        'keterangan' => 'Tidak melakukan absensi',
                    ]);
                }
                // Maju ke hari berikutnya
                $nextDate->addDays();
            }
        }
            // simpan absen masuk
            Absensi::create([
                'id_siswa' => Auth::user()->siswa->id,
                'tanggal' => $today,
                'jam_masuk' => $request->status == 'hadir' ? now()->format('H:i:s') : null,
                'status' => $request->status,
                'keterangan' => $request->status == 'hadir' ? null : $request->keterangan,
            ]);
            return back()->with('success', 'Absensi Masuk Berhasil.');
        }
        public function absenPulang($id)  {
            $absensi = Absensi::findOrFail($id);

            if ($absensi->status != 'hadir') {
                return back()->with('error', 'Absen pulang hanya untuk siswa yang hadir.');
            }
            if ($absensi->jam_keluar !== null ) {
                return back()->with('error', ' Sudah Absen pulang sebelumnya.');
            }
            $absensi->update([
                'jam_keluar' => now()->format('H:i:s')
            ]);
            return back()->with('success', 'Absen Pulang Berhasil');

        }
    }

