@extends('layouts.app')
@section('title', 'Edit Kelas')
@section('content')

<section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Kelas</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.kelas.update', $kelas->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_kelas">Nama Kelas</label>
                            <input type="text" name="nama_kelas"  id="nama_kelas" class="form-control" value="{{ old('nama_kelas', $kelas->nama_kelas)}}" required>
                            @error('nama_kelas')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
                </form>
            </div>
        </div> 
    </section>
@endsection