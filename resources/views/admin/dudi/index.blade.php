@extends('layouts.app')

@section('title', 'Dudi')

@section('content')
<section class="section">

    @if(session('success'))
    <div class="alert alert-success small">{{ session('success')}}</div>
    @endif
     @if(session('error'))
    <div class="alert alert-danger small">{{ session('error')}}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                <a href="{{ route('admin.dudi.create') }}" class="btn btn-primary">+ Tambah</a>
            </h5>
        </div>

        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dudi</th>
                        <th>Bidang Usaha</th>
                        <th>Alamat</th>
                        <th>Direktur Dudi</th>
                        <th>Pembimbing Dudi</th>
                        <th>Kontak</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dudis as $dudi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dudi->nama_dudi }}</td>
                        <td>{{ $dudi->bidang_usaha }}</td>
                        <td>{{ $dudi->alamat }}</td>
                        <td>{{ $dudi->direktur_dudi }}</td>
                        <td>{{ $dudi->pembimbing_dudi }}</td>
                        <td>{{ $dudi->kontak }}</td>
                        <td>
                            <a href=" {{ route('admin.dudi.edit', $dudi->id)}}" class="btn btn-warning btn-sm">Edit</a>
                            <form class="d-inline" action="{{ route('admin.dudi.destroy', $dudi->id)}}" method="post" onsubmit="return confirm('yakin ingin menghapus?')">
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