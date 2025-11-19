@extends('layouts.app')

@section('title', 'Profil Siswa')

@section('content')
<section class="section">
    {{-- Alert sukses --}}
    @if (session('success'))
    <div id="alert-success"
        class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3 px-4 py-3 mt-2 small"
        role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            const alert = document.getElementById('alert-success');
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 3000);
    </script>
    @endif

    @if ($errors->any())
    <div id="alert-danger"
        class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-3 px-4 py-3 mt-2 small"
        role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ $errors->first() }}
    </div>

    <script>
        setTimeout(() => {
            const alert = document.getElementById('alert-danger');
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 3000);
    </script>
    @endif

    {{-- Card Profil --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header border-0 py-3 px-4 d-flex align-items-center justify-content-between"
            style="background-color: var(--bs-primary);">
            <h5 class="mb-0 fw-semibold text-white">
                <i class="bi bi-person-badge-fill me-2 text-white"></i> Profil Siswa
            </h5>
        </div>

        <form action="{{ route('siswa.profile.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body px-4 py-4">
                <div class="row g-4 align-items-start">
                    {{-- Bagian kiri: Foto & Identitas singkat --}}
                    <div class="col-lg-4 text-center">
                        <div class="p-3 border-0 shadow-sm rounded-4"
                            style="background-color: var(--bs-body-bg); color: var(--bs-body-color);">

                            {{-- FOTO PROFIL + ICON CAMERA --}}
                            <div class="mb-3 position-relative d-inline-block">

                                @if ($siswa->foto)
                                <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto Profil"
                                    class="img-fluid rounded-circle shadow-sm  border-primary-subtle"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                <div class="rounded-circle shadow-sm d-flex justify-content-center align-items-center" style="width: 150px; height: 150px; background-color: var(--bs-secondary-bg);">
                                    <i class="bi bi-person-fill" style="font-size: 3rem; color: var(--bs-secondary-color);"></i>
                                </div>
                                @endif

                                <!-- Input file disembunyikan -->
                                <input type="file" id="uploadFoto" name="foto" class="d-none" onchange="this.form.submit()">

                                <!-- Label sebagai tombol kamera -->
                                <label for="uploadFoto" class="position-absolute d-flex justify-content-center align-items-center rounded-circle" style="width: 32px; height: 32px; bottom: 0; left: 50%; transform: translate(-50%, 35%);border: 2px solid white; background-color: var(--bs-primary); cursor: pointer;">
                                    <i class="bi bi-camera-fill text-white" style="font-size: 14px; line-height: 1; margin-top: 1px;"></i>
                                </label>


                            </div>
                            {{-- END FOTO PROFIL --}}

                            <h6 class="fw-semibold mb-1">{{ $siswa->user->name ?? '-' }}</h6>
                            <p class="small mb-0">{{ $siswa->user->email ?? '-' }}</p>
                            <hr class="my-3 opacity-50">
                            <div class="small text-muted text-start ps-3">
                                <div class="mb-1"><i class="bi bi-tag me-1"></i> <strong>NIS:</strong> {{ $siswa->nis ?? '-' }}</div>
                                <div class="mb-1"><i class="bi bi-building me-1"></i> <strong>DUDI:</strong> {{ $siswa->dudi->nama_dudi ?? '-' }}</div>
                                <div><i class="bi bi-person-workspace me-1"></i> <strong>Pembimbing:</strong> {{ $siswa->pembimbing->name ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- Bagian kanan: Detail informasi --}}
                    <div class="col-lg-8">
                        <div class="shadow-sm rounded-4 p-4"
                            style="background-color: var(--bs-body-bg); color: var(--bs-body-color);">
                            <h6 class="fw-semibold mb-3 text-primary d-flex align-items-center">
                                <i class="bi bi-info-circle me-2"></i> Informasi Pribadi
                            </h6>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control bg-transparent border shadow-sm rounded-3 py-2" value="{{ $siswa->user->name ?? '-' }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Email</label>
                                    <input type="email" name="email" class="form-control bg-transparent border shadow-sm rounded-3 py-2" value="{{ $siswa->user->email ?? '-' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Password</label>
                                    <input type="password" name="password" class="form-control bg-transparent border shadow-sm rounded-3 py-2">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control bg-transparent border shadow-sm rounded-3 py-2" value="{{ $siswa->tempat_lahir ?? '-' }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control bg-transparent border shadow-sm rounded-3 py-2" value="{{ $siswa->tanggal_lahir }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="" class="form-control bg-transparent border shadow-sm rounded-3 py-2">
                                        <option value="laki-laki" {{ $siswa->jenis_kelamin == 'laki-laki' ? 'selected' : ''}}>Laki-laki</option>
                                        <option value="perempuan" {{ $siswa->jenis_kelamin == 'perempuan' ? 'selected' : ''}}>Perempuan</option>
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">DUDI (Tempat Magang)</label>
                                    <div class="form-control bg-transparent border shadow-sm rounded-3 py-2">
                                        {{ $siswa->dudi->nama_dudi ?? '-' }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Pembimbing</label>
                                    <div class="form-control bg-transparent border shadow-sm rounded-3 py-2">
                                        {{ $siswa->pembimbing->name ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-end py-3 px-4 border-0"
                style="background-color: var(--bs-body-bg);">
                <button type="submit" class="btn btn-warning fw-semibold shadow-sm px-4">
                    <i class="bi bi-pencil-square me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</section>
@endsection