@extends('layouts.app')
@section('title', 'Tambah Siswa')
@section('content')

<section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Siswa</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.siswa.store')}}" method="post">
                    @csrf
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" id="name">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nis">NIS</label>
                            <input type="text" name="nis" class="form-control" id="nis">
                            @error('nis')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin"  id="jenis_kelamin" class="form-control">
                            <option value="">--Pilih--</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir">
                            @error('tempat_lahir')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir">
                            @error('tanggal_lahir')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="id_kelas">Kelas</label>
                            <select name="id_kelas" id="id_kelas" class="form-control">
                            <option value="">--Pilih--</option>
                            @foreach($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas}}</option>
                            @endforeach
                            </select>
                            @error('id_kelas')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="id_pembimbing">Pembimbing</label>
                            <select name="id_pembimbing" id="id_pembimbing" class="form-control">
                            <option value="">--Pilih Pembimbing--</option>
                            @foreach($pembimbings as $pembimbing)
                            <option value="{{ $pembimbing->id}}">{{ $pembimbing->name }}</option>
                            @endforeach
                            </select>
                            @error('id_pembimbing')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="id_dudi">Dudi</label>
                            <select name="id_dudi" id="id_dudi" class="form-control">
                            <option value="">--Pilih Dudi--</option>
                            @foreach($dudis as $dudi)
                            <option value="{{ $dudi->id}}">{{ $dudi->nama_dudi }}</option>
                            @endforeach
                            </select>
                            @error('id_dudi')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
                </form>
            </div>
        </div> 
    </section>
@endsection