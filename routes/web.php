<?php

use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DudiController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\SiswaController;
use GuzzleHttp\Middleware;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::get('/', function () {
  return view('welcome');
});

Route::middleware('guest')->group(function () {
  route::get('/login', [AuthController::class, 'tampil_login'])->name('login');
  route::post('/login/submit', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
  route::get('/kegiatan', [KegiatanController::class, 'kegiatan'])->name('kegiatan');
  route::get('/absensi', [AbsensiController::class, 'absensi'])->name('absensi');
  route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas']);
  Route::resource('dudi', DudiController::class);
  Route::resource('pembimbing', PembimbingController::class);
  Route::resource('siswa', SiswaController::class);
  Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('siswa')->name('siswa.')->middleware(['auth', 'role:siswa'])->group(function () {
  route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  route::resource('kegiatan', KegiatanController::class);
  route::resource('absensi', AbsensiController::class);
  Route::get('/absensi/pulang/{id}', [AbsensiController::class, 'absenPulang'])->name('absensi.pulang');
  Route::get('/profil', [SiswaController::class, 'profile'])->name('profile');
  Route::put('/profil/update', [SiswaController::class, 'profileUpdate'])->name('profile.update');
});
Route::prefix('pembimbing')->name('pembimbing.')->middleware(['auth', 'role:pembimbing'])->group(function () {
  route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  route::get('/siswa', [SiswaController::class, 'siswa'])->name('siswa.index');
  route::get('/siswa/kegiatan/{id}', [SiswaController::class, 'siswaKegiatan'])->name('siswa.kegiatan');
  route::put('/siswa/kegiatan/update/{id}', [SiswaController::class, 'siswaKegiatanUpdate'])->name('siswa.kegiatan.update');
  route::get('/siswa/absensi/{id}', [SiswaController::class, 'siswaAbsensi'])->name('siswa.absensi');

  
});


