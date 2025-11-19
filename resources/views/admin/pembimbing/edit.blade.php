@extends('layouts.app')
@section('title', 'Edit Pembimbing')
@section('content')

<section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Pembimbing</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.pembimbing.update', $pembimbing->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_kelas">Nama</label>
                            <input type="text" name="name"  id="name" class="form-control" value="{{ old('name', $pembimbing->name)}}" required>
                            @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email"  id="email" class="form-control" value="{{ old('email', $pembimbing->email)}}" required>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.pembimbing.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
                </form>
            </div>
        </div> 
    </section>
@endsection