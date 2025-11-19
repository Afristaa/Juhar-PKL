@extends('layouts.app')

@section('title', 'Absensi')

@section('content')
<section class="section">

    @if(session('success'))
    <div class="alert alert-success small">{{ session('success')}}</div>
    @endif

    <div class="card-header"
        style="background: linear-gradient(135deg, #4e73df, #1cc88a); 
            padding: 20px; 
            border-radius: 8px 8px 0 0;">
        <h4 class="card-title text-white m-0 fw-bold" style="letter-spacing: 0.5px;">
            <i class="bi bi-person-fill me-2"></i>
            Nama: {{ $siswa->user->name }} <br>
            Nama: {{ $siswa->kelas->nama_kelas }} <br>
            Nama: {{ $siswa->dudi->nama_dudi }} <br>
        </h4>
    </div>
    <div class="card-body">
        <table class="table table-striped" id="table1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($absensis as $absensi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $absensi->tanggal }}</td>
                    <td>{{ $absensi->jam_masuk ?? '_' }}</td>
                    <td>{{ $absensi->jam_keluar ?? '_'}}</td>
                    <td>{{ $absensi->status }}</td>
                    <td>{{ $absensi->keterangan ?? '_' }}</td>
                    <td>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</section>
@endsection