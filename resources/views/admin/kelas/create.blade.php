@extends('layouts.app')
@section('title', 'Tambah Kelas')
@section('content')

<section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Kelas</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.kelas.store')}}" method="post">
                    @csrf
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_kelas">Nama Kelas</label>
                            <input type="text" name="nama_kelas" class="form-control" id="nama_kelas">
                            @error('nama_kelas')
                            <div class="invalidate-feedback">{{ $message }}</div>
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