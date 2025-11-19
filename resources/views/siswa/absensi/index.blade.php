@extends('layouts.app')

@section('title', 'Absensi')

@section('content')
<section class="section">

    @if(session('success'))
    <div class="alert alert-success small">{{ session('success')}}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger small">{{ session('error')}}</div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger small">{{ $errors->first() }}</div>
    @endif


    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                <form action="{{  route ('siswa.absensi.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="hadir">Hadir</option>
                                    <option value="izin">Izin</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="libur">Libur</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mt-4">
                                <button type="submit" class="btn btn-danger">Masuk</button>
                            </div>
                        </div>
                    </div>
                </form>
            </h5>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($absensis as $absensi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $absensi->siswa->user->name }}</td>
                        <td>{{ $absensi->tanggal ?? '_'}}</td>
                        <td>{{ $absensi->jam_masuk ?? '_' }}</td>
                        <td>{{ $absensi->jam_keluar ?? '_'}}</td>
                        <td>{{ $absensi->status ?? '_'}}</td>
                        <td>{{ $absensi->keterangan ?? '_'}}</td>
                        <td>
                            @if($absensi->status == 'hadir' && $absensi->jam_keluar == null)
                            <a href="{{ route('siswa.absensi.pulang', $absensi->id)}}" class="btn btn-success btn-sm">Pulang</a>
                             @else
                             <span class="badge bg-secondary">Selesai</span>
                             @endif
                        </td>
                    </tr>
        </div>
    </div>
    @endforeach
    </tbody>
    </table>
    </div>
    </div>
</section>
<script>
    document.getElementById('status').addEventListener('change', function() { // document.getElementById('status') Cari elemen HTML yang punya atribut id="status" yg di select option, (.) penghubung untuk mengambil datanya

    document.getElementById('keterangan').disabled = (this.value ===  'hadir'); // ambil id keterangan di input
    });
</script>
@endsection