@extends('layouts.app')
@section('title', 'Tambah Kegiatan')
@section('content')

<section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Kegiatan</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('siswa.kegiatan.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" id="tanggal">
                            @error('tanggal')
                            <div class="invalidate-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jam_mulai">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control" id="jam_mulai">
                            @error('jam_mulai')
                            <div class="invalidate-feedback">{{ $message }}</div>
                            @enderror
                        </div><div class="form-group">
                            <label for="jam_selesai">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control" id="jam_selesai">
                            @error('jam_selesai')
                            <div class="invalidate-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        </div><div class="form-group">
                            <label for="kegiatan">Kegiatan</label>
                            <textarea name="kegiatan" id="kegiatan" rows="5" class="form-control"></textarea>
                            @error('jam_selesai')
                            <div class="invalidate-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        </div><div class="form-group">
                            <label for="dokumentasi">Dokumentasi</label>
                            <input type="file" name="dokumentasi" class="form-control" id="dokumentasi">
                            @error('dokumentasi')
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