@extends('layouts.app')
@section('title', 'Edit Dudi')
@section('content')

<section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Dudi</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.dudi.update', $dudi->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_dudi">Nama Dudi</label>
                            <input type="text" name="nama_dudi"  id="nama_dudi" class="form-control" value="{{ old('nama_dudi', $dudi->nama_dudi)}}" required>
                            @error('nama_dudi')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama">Bidang Usaha</label>
                            <input type="text" name="bidang_usaha"  id="bidang_usaha" class="form-control" value="{{ old('bidang_usaha', $dudi->bidang_usaha)}}" required>
                            @error('bidang_usaha')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat"  id="alamat" class="form-control" value="{{ old('alamat', $dudi->alamat)}}" required>
                            @error('alamat')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="direktur_dudi">Direktur Dudi</label>
                            <input type="text" name="direktur_dudi"  id="direktur_dudi" class="form-control" value="{{ old('direktur_dudi', $dudi->direktur_dudi)}}" required>
                            @error('direktur_dudi')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pembimbing_dudi">Pembimbing Dudi</label>
                            <input type="text" name="pembimbing_dudi"  id="pembimbing_dudi" class="form-control" value="{{ old('pembimbing_dudi', $dudi->pembimbing_dudi)}}" required>
                            @error('pembimbing_dudi')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kontak">Kontak</label>
                            <input type="text" name="kontak"  id="kontak" class="form-control" value="{{ old('kontak', $dudi->kontak)}}" required>
                            @error('kontak')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.dudi.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
                </form>
            </div>
        </div> 
    </section>
@endsection