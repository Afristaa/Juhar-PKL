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
                <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary">+ Tambah</a>
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
                        <th>TTL</th>
                        <th>Kelas</th>
                        <th>Dudi</th>
                        <th>Pembimbing</th>
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
                        <td>{{ $siswa->tampat }}, {{ $siswa->tanggal_lahir }}</td>
                        <td>{{ $siswa->kelas->nama_kelas }}</td>
                        <td>{{ $siswa->dudi->nama_dudi }}</td>
                        <td>{{ $siswa->pembimbing->name }}</td>
                        <td>
                            <a href=" {{ route('admin.siswa.edit', $siswa->id)}}" class="btn btn-warning btn-sm">Edit</a>
                            <form class="d-inline" action="{{ route('admin.siswa.destroy', $siswa->id)}}" method="post" onsubmit="return confirm('yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection