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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Profiler\Profile;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with(['user', 'pembimbing', 'kelas', 'dudi'])->get();
        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        $dudis = Dudi::all();
        $pembimbings = User::where('role', 'pembimbing')->get();
        return view('admin.siswa.create', compact('kelas', 'dudis', 'pembimbings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',

            'nis' => 'required|unique:siswas,nis',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'id_kelas' => 'required',
            'id_dudi' => 'required',
            'id_pembimbing' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        Siswa::create([
            'id_user' => $user->id,
            'nis' => $request->nis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'id_kelas' => $request->id_kelas,
            'id_dudi' => $request->id_dudi,
            'id_pembimbing' => $request->id_pembimbing,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambah');
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        $dudis = Dudi::all();
        $pembimbings = User::where('role', 'pembimbing')->get();
        return view('admin.siswa.edit', compact('kelas', 'siswa', 'dudis', 'pembimbings'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $user = User::findOrFail($siswa->id_user); // Perbaikan disini

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',

            'nis' => 'required|unique:siswas,nis,' . $siswa->id,
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'id_kelas' => 'required',
            'id_dudi' => 'required',
            'id_pembimbing' => 'required',
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $siswa->update([
            'nis' => $request->nis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'id_kelas' => $request->id_kelas,
            'id_dudi' => $request->id_dudi,
            'id_pembimbing' => $request->id_pembimbing,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil di edit');
    }

    public function destroy(Siswa $siswa)
    {
        
        $user = User::find($siswa->id_user); //
        $kegiatans = Kegiatan::where('id_siswa', $siswa->id)->get(); // id_siswa itu id dari si siswa
        foreach ($kegiatans as $kegiatan) {
            if ($kegiatan->dokumentasi) {
                Storage::disk('public')->delete($kegiatan->dokumentasi);
            }   
        }
        if ( $siswa->foto) {
         Storage::disk('public')->delete($siswa->foto); 
        }
        $user->delete();
        $siswa->delete();
        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }


    public function profile()
    {
        $siswa = Siswa::where('id_user', Auth::user()->id)->first();
        return view('siswa.profile.index', compact('siswa'));
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user(); // dapetin data user yang login
        $siswa = $user->siswa; // dapetin data siswa berdasarkan user yang login

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8', // password ini boleh diganti atau ga, jadi nullable boleh kosong

            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg',
        ]);

        if ($request->filled('password')) { //jika ada request password maka password yg id user di gangi baru
            $user->password = Hash::make($request->password);
        }

        $dataUser = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $user->password,
        ];

        $dataSiswa = [

            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
        ];
        if ($request->hasFile('foto')) {
            if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
            }
            $dataSiswa['foto'] = $request->file('foto')->store('profile', 'public');
        }

        $user->update($dataUser);
        $siswa->update($dataSiswa);
        return redirect()->route('siswa.profile')->with('success', 'Siswa berhasil di update.');
    }
    public function siswa()
    {
        $siswas = Siswa::where('id_pembimbing', Auth::user()->id)->get();
        return view('pembimbing.siswa.index', compact('siswas'));
    }
    public function siswaKegiatan($id)
    {
        $siswaId = Siswa::where('id', $id)->where('id_pembimbing', Auth::user()->id)->first(); // id didapat dari parameter url, berdasarkan pembimbing yang login

        if (! $siswaId) { // ketika pembimbing ingin mengambil data kegiatan siswa maka pembimbing itu tidak bisa,karena siswa tersebut bukan siswa yang dia bimbing
            abort('403', 'Anda tidak memiliki akses untuk melihat kegiatan siswa ini');
        }
        $siswa = Siswa::findOrFail($id); // ini id siswa yg untuk menentukan siswa yang mana
        $kegiatans = Kegiatan::where('id_siswa', $id)->orderBy('tanggal', 'desc')->get();
        return view('pembimbing.siswa.kegiatan', compact('kegiatans', 'siswa'));
    }
    public function siswaKegiatanUpdate(Request $request, $id)
    {
        $kegiatan = Kegiatan::find($id);

        $request->validate([
            'catatan_pembimbing' => 'required',

        ]);
        $kegiatan->update([
            'catatan_pembimbing' => $request->catatan_pembimbing,
        ]);
        return back()->with('success', 'Catatan berhasil ditambahkan');
    }
    public function siswaAbsensi($id)
    {
        $siswaId = Siswa::where('id', $id)->where('id_pembimbing', Auth::user()->id)->first(); // id didapat dari parameter url, berdasarkan pembimbing yang login
        if (! $siswaId) { // ketika pembimbing ingin mengambil data kegiatan siswa maka pembimbing itu tidak bisa,karena siswa tersebut bukan siswa yang dia bimbing
            abort('403', 'Anda tidak memiliki akses untuk melihat kegiatan siswa ini');
        }
        $siswa = Siswa::findOrFail($id); // ini id siswa yg untuk menentukan siswa yang mana
        $absensis = Absensi::where('id_siswa', $id)->orderBy('tanggal', 'desc')->get();
        return view('pembimbing.siswa.absensi', compact('absensis', 'siswa'));
    }
    
}
