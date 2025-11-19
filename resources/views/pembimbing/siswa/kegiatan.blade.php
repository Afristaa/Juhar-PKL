@extends('layouts.app')

@section('title', 'Kegiatan')

@section('content')
<section class="section">

    @if(session('success'))
    <div class="alert alert-success small">{{ session('success')}}</div>
    @endif

    <div class="card-header"
        style="background: linear-gradient(135deg, #4e73df, #1cc88a);
            padding: 16px;
            border-radius: 8px 8px 0 0;">

        <div style="display: grid;
                grid-template-columns: 100px 1fr;
                row-gap: 6px;
                font-size: 14px;
                color: #fff;">

            <div><strong>Nama :</strong></div>
            <div>{{ $siswa->user->name }}</div>

            <div><strong>Kelas :</strong></div>
            <div>{{ $siswa->kelas->nama_kelas }}</div>

            <div><strong>Tempat PKL :</strong></div>
            <div>{{ $siswa->dudi->nama_dudi }}</div>

        </div>
    </div>


    <div class="card-body">
        <table class="table table-striped" id="table1">
            <thead>
                <tr>
                    <th>No</th>
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
                    <td>{{ $kegiatan->jam_mulai ?? '_' }}</td>
                    <td>{{ $kegiatan->jam_selesai ?? '_'}}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailKegiatan{{ $kegiatan->id }}">
                            Detail
                        </button>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#catatanPembimbing{{ $kegiatan->id }}">
                            Catatan
                        </button>
                    </td>
                </tr>
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

                <div class="modal fade" id="catatanPembimbing{{ $kegiatan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Catatan Kegiatan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body"> <!-- Modal body ini di ambil dari edit yang untuk menampilkan -->
                                <form action="{{ route('pembimbing.siswa.kegiatan.update', $kegiatan->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <div>
                                            <label for="catatan_pembimbing">Catatan Pembimging</label>
                                            <textarea name="catatan_pembimbing" id="catatan_pembimbing" rows="5" class="form-control">{{ $kegiatan->catatan_pembimbing }}</textarea>
                                            @error('jam_selesai')
                                            <div class="invalidate-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
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