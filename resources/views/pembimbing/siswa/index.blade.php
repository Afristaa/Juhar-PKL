@extends('layouts.app')

@section('title', 'Siswa')

@section('content')
<section class="section">

    @if(session('success'))
    <div class="alert alert-success small">{{ session('success')}}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
            </h5>
        </div>

        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nis</th>
                        <th>Jenis Kelamin</th>
                        <th>Kelas</th>
                        <th>Dudi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswas as $siswa)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $siswa->user->name }}</td>
                        <td>{{ $siswa->nis }}</td>
                        <td>{{ $siswa->jenis_kelamin }}</td>
                        <td>{{ $siswa->kelas->nama_kelas }}</td>
                        <td>{{ $siswa->dudi->nama_dudi }}</td>
                        <td>
                            <a href=" {{route('pembimbing.siswa.kegiatan', $siswa->id)}}" class="btn btn-primary btn-sm">Kegiatan</a>
                            <a href=" {{ route('pembimbing.siswa.absensi', $siswa->id)}}" class="btn btn-secondary btn-sm">Absensi</a>
                        </td>
                    </tr>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection