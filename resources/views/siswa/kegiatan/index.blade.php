@extends('layouts.app')

@section('title', 'Kegiatan')

@section('content')
<section class="section">

    @if(session('success'))
    <div class="alert alert-success small">{{ session('success')}}</div>
    @endif


    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                <a href="{{ route('siswa.kegiatan.create') }}" class="btn btn-primary">+ Tambah</a>
            </h5>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kegiatans as $kegiatan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kegiatan->tanggal }}</td>
                        <td>{{ $kegiatan->jam_mulai }}</td>
                        <td>{{ $kegiatan->jam_selesai }}</td>
                        <td>
                            <a href=" {{ route('siswa.kegiatan.edit', $kegiatan->id)}}" class="btn btn-warning btn-sm">Edit</a>
                            <form class="d-inline" action="{{ route('siswa.kegiatan.destroy', $kegiatan->id)}}" method="post" onsubmit="return confirm('yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus </button>
                            </form>
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailKegiatan{{ $kegiatan->id }}">
                                Detail
                            </button>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="detailKegiatan{{ $kegiatan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Kegiatan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body"> <!-- Modal body ini di ambil dari edit yang untuk menampilkan -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tanggal">Tanggal</label>
                                                <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{ old('tanggal', $kegiatan->tanggal) }}" disabled>
                                                @error('tanggal')
                                                <div class="invalidate-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="jam_mulai">Jam Mulai</label>
                                                <input type="time" name="jam_mulai" class="form-control" id="jam_mulai" value="{{ old('jam_mulai', $kegiatan->jam_mulai) }}" disabled>
                                                @error('jam_mulai')
                                                <div class="invalidate-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="jam_selesai">Jam Selesai</label>
                                                <input type="time" name="jam_selesai" class="form-control" id="jam_selesai" value="{{ old('jam_selesai', $kegiatan->jam_selesai) }}" disabled>
                                                @error('jam_selesai')
                                                <div class="invalidate-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kegiatan">Kegiatan</label>
                                            <textarea name="kegiatan" id="kegiatan" rows="5" disabled class="form-control">{{ $kegiatan->kegiatan }}</textarea>
                                            @error('jam_selesai')
                                            <div class="invalidate-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="catatan_pembimbing">Catatan Pembimging</label>
                                        <textarea name="catatan_pembimbing" id="catatan_pembimbing" rows="5" disabled class="form-control">{{ $kegiatan->catatan_pembimbing }}</textarea>
                                        @error('jam_selesai')
                                        <div class="invalidate-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="dokumentasi">Dokumentasi</label><br>
                                        <img src="{{ asset('storage/'. $kegiatan->dokumentasi) }}" alt="Dokumentasi" width="200">
                                        @error('dokumentasi')
                                        <div class="invalidate-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
    @endforeach
    </tbody>
    </table>
    </div>
    </div>
</section>
@endsection