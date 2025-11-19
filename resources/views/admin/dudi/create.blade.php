@extends('layouts.app')
@section('title', 'Tambah Dudi')
@section('content')

<section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Dudi</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.dudi.store')}}" method="post">
                    @csrf
                     <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_dudi">Nama Dudi</label>
                            <input type="text" name="nama_dudi" class="form-control" id="nama_dudi">
                            @error('nama_dudi')
                            <div class="invalidate-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bidang_usaha">Bidang Usaha</label>
                            <input type="text" name="bidang_usaha" class="form-control" id="bidang_usaha">
                            @error('bidang_usaha')
                            <div class="invalidate-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control" id="alamat">
                            @error('alamat')
                            <div class="invalidate-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="direktur_dudi">Direktur Dudi</label>
                            <input type="text" name="direktur_dudi" class="form-control" id="direktur_dudi">
                            @error('direktur_dudi')
                            <div class="invalidate-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pembimbing_dudi">Pembimbing Dudi</label>
                            <input type="text" name="pembimbing_dudi" class="form-control" id="pembimbing_dudi">
                            @error('pembimbing_dudi')
                            <div class="invalidate-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kontak">Kontak</label>
                            <input type="text" name="kontak" class="form-control" id="kontak">
                            @error('kontak')
                            <div class="invalidate-feedback">{{ $message }}</div>
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