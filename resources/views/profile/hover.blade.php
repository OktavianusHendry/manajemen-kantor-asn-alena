@extends('layouts.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 style="font-size: 2.0em;"><b>Profil Anda</b></h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="form-label">Nama</label>
                            <p>{{ $user->name }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Role</label>
                            <p>{{ $user->role_as == 1 ? 'Admin' : ($user->role_as == 2 ? 'Karyawan' : 'Mentor') }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Foto Diri</label>
                            @if ($user->foto_diri)
                                <img src="{{ asset('storage/' . $user->foto_diri) }}" alt="Foto Diri" class="img-fluid">
                            @else
                                <p>Belum diunggah</p>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Foto KTP</label>
                            @if ($user->foto_ktp)
                                <img src="{{ asset('storage/' . $user->foto_ktp) }}" alt="Foto KTP" class="img-fluid">
                            @else
                                <p>Belum diunggah</p>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Alamat</label>
                            <p>{{ $user->alamat }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Jabatan</label>
                            <p>{{ $user->jabatan->nama_jabatan ?? 'Belum diatur' }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Divisi</label>
                            <p>{{ $user->divisi->nama_divisi ?? 'Belum diatur' }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">No. Telepon</label>
                            <p>{{ $user->no_telepon ?? 'Belum diisi' }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Tanggal Bergabung</label>
                            <p>{{ $user->tanggal_bergabung ?? 'Belum diisi' }}</p>
                        </div>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Lengkapi Profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
