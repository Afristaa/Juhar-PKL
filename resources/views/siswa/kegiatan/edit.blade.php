@extends('layouts.app')
@section('title', 'Edit Kegiatan')
@section('content')

<section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Kegiatan</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('siswa.kegiatan.update', $kegiatan->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{ old('tanggal', $kegiatan->tanggal) }}">
                            @error('tanggal')
                            <div class="invalidate-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jam_mulai">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control" id="jam_mulai" value="{{ old('jam_mulai', $kegiatan->jam_mulai) }}">
                            @error('jam_mulai')
                            <div class="invalidate-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jam_selesai">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control" id="jam_selesai" value="{{ old('jam_selesai', $kegiatan->jam_selesai) }}">
                            @error('jam_selesai')
                            <div class="invalidate-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="kegiatan">Kegiatan</label>
                            <textarea name="kegiatan" id="kegiatan" rows="5" class="form-control">{{ $kegiatan->kegiatan }}</textarea>
                            @error('jam_selesai')
                            <div class="invalidate-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="dokumentasi">Dokumentasi</label><br>
                            <img src="{{ asset('storage/'. $kegiatan->dokumentasi) }}" alt="Dokumentasi" width="200">
                            <input type="file" name="dokumentasi" class="form-control" id="dokumentasi" value=" {{ old('dokumentasi', $kegiatan->dokumentasi) }}">
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