@extends('layouts.app')

@section('title', 'Absensi')

@section('content')
<section class="section">

    @if(session('success'))
    <div class="alert alert-success small">{{ session('success')}}</div>
    @endif

        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($absensis as $absensi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $absensi->siswa->user->name }}</td>
                        <td>{{ $absensi->tanggal }}</td>
                        <td>{{ $absensi->jam_masuk }}</td>
                        <td>{{ $absensi->jam_keluar }}</td>
                        <td>{{ $absensi->status }}</td>
                        <td>{{ $absensi->keterangan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection