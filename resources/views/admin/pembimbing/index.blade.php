@extends('layouts.app')

@section('title', 'Pembimbing')

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
                <a href="{{ route('admin.pembimbing.create') }}" class="btn btn-primary">+ Tambah</a>
            </h5>
        </div>

        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembimbings as $pembimbing)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pembimbing->name }}</td>
                        <td>{{ $pembimbing->email }}</td>
                        <td>
                            <a href=" {{ route('admin.pembimbing.edit', $pembimbing->id)}}" class="btn btn-warning btn-sm">Edit</a>
                            <form class="d-inline" action="{{ route('admin.pembimbing.destroy', $pembimbing->id)}}" method="post" onsubmit="return confirm('yakin ingin menghapus?')">
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