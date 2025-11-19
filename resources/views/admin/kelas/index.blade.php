@extends('layouts.app')

@section('title', 'Kelas')

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
                <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary">+ Tambah</a>
            </h5>
        </div>

        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kelas as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_kelas }}</td>
                        <td>
                            <a href=" {{ route('admin.kelas.edit', $item->id)}}" class="btn btn-warning btn-sm">Edit</a>
                            <form class="d-inline" action="{{ route('admin.kelas.destroy', $item->id)}}" method="post" onsubmit="return confirm('yakin ingin menghapus?')">
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