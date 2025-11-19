@extends('layouts.app')

@section('title', 'Kegiatan')

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
                        <th>Kelas</th>
                        <th>Dudi</th>
                        <th>Tanggal</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kegiatans as $kegiatan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kegiatan->siswa->user->name }}</td>
                        <td>{{ $kegiatan->siswa->kelas->nama_kelas }}</td>
                        <td>{{ $kegiatan->siswa->dudi->nama_dudi }}</td>
                        <td>{{ $kegiatan->tanggal }}</td>
                        <td>{{ $kegiatan->jam_mulai }}</td>
                        <td>{{ $kegiatan->jam_selesai }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection