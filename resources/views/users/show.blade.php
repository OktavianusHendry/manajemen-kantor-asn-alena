@extends('layouts.template')

@section('content')
    <div id="app">
        <main class="py-4">
            <div class="container">

                <div class="row">
                    <!-- Detail Karyawan Section -->
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                Detail Info User&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;{{ $user->role_name }}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <tbody>
                                            <br>
                                            <tr>
                                                <th scope="row"><b>Nama</b></th>
                                                <td>{{ $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><b>Alamat</b></th>
                                                <td>{{ $user->alamat }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><b>No. Telepon</b></th>
                                                <td>{{ $user->no_telepon }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><b>Email</b></th>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><b>Jabatan</b></th>
                                                @if ($user->divisi)
                                                    <td>{{ $user->jabatan->nama_jabatan }}</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <th scope="row"><b>Divisi</b></th>
                                                @if ($user->divisi)
                                                    <td>{{ $user->divisi->nama_divisi }}&nbsp;&nbsp;({{ $user->divisi->kode_divisi }})
                                                    </td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><b>Surat Tugas (Mentor)</b></th>
                                                <td>
                                                    @if ($user->surat_tugas)
                                                        <!-- Check if surat_tugas exists -->
                                                        <a href="{{ asset('storage/' . $user->surat_tugas) }}"
                                                            target="_blank"
                                                            class="btn btn-success btn-sm">Lihat</a>&nbsp;&nbsp;
                                                    @else
                                                        Tidak ada dokumen
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><b>Bergabung Pada</b></th>
                                                <td>{{ $user->created_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <p class="muted">Diperbarui pada :
                                        {{ $user->updated_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}</p>
                                </div>
                                <br>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('users.index') }}" class="btn btn-warning">Kembali</a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Foto Pegawai Section -->
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header bg-success text-white">
                                Foto
                            </div>
                            <div class="card-body text-center mt-3">
                                <img class="img-fluid mb-3" src="{{ asset('storage/' . $user->foto_diri) }}"
                                    alt="Foto Diri">
                                <p>{{ $user->name }}</p>
                                <br>
                                <img class="img-fluid" src="{{ asset('storage/' . $user->foto_ktp) }}" alt="Foto KTP">
                                <p class="mt-2">KTP</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

<style>
    .table th,
    .table td {
        border-top: none;
    }

    .card-header {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .card-body p {
        margin-bottom: 0.5rem;
    }
</style>
