@extends('layouts.app')
@section('title', 'Tambah Pembimbing')
@section('content')

<section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Pembimbing</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.pembimbing.store')}}" method="post">
                    @csrf
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" id="name">
                            @error('name')
                            <div class="invalidate-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email">
                            @error('email')
                            <div class="invalidate-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                            @error('password')
                            <div class="invalidate-feedback">{{ $message }}</div>
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