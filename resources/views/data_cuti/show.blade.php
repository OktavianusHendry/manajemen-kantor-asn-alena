@extends('layouts.template')

@section('content')
    <div id="app">
        <div class="container-xxl flex-grow-1 container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Detail Cuti</b>
                        <span class="text-muted fw-light">/ Informasi Pengajuan Cuti</span>
                    </h2>
                </div>
                <div class="card mb-4">
                    <br>
                    <div class="container">
                        <table class="table">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $cuti->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Cuti</th>
                                <td>{{ $cuti->Jenis_Cuti->nama_jenis_cuti ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Mulai</th>
                                <td>{{ $cuti->tanggal_mulai }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Selesai</th>
                                <td>{{ $cuti->tanggal_selesai }}</td>
                            </tr>
                            <tr>
                                <th>Alasan</th>
                                <td>{{ $cuti->alasan }}</td>
                            </tr>
                            <tr>
                                <th>Catatan</th>
                                <td>{{ $cuti->catatan }}</td>
                            </tr>
                            <tr>
                                <th>Status Direktur</th>
                                <td>
                                    <button class="btn btn-{{ $cuti->approved_by_director == 'approved' ? 'success' : ($cuti->approved_by_director == 'rejected' ? 'danger' : 'warning') }}btn-sm" disabled>
                                        {{ ucfirst($cuti->approved_by_director) }}
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th>Status Kepala Academy</th>
                                <td>
                                    <button class="btn btn-{{ $cuti->approved_by_head_acdemy == 'approved' ? 'success' : ($cuti->approved_by_head_acdemy == 'rejected' ? 'danger' : 'warning') }}btn-sm" disabled>
                                        {{ ucfirst($cuti->approved_by_head_acdemy) }}
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <a href="{{ route('data_cuti.index') }}" class="btn btn-secondary">Kembali</a>
                            </tr>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
