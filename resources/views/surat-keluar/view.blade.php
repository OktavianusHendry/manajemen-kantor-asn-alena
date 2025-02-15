@extends('layouts.template') <!-- Ganti dengan layout yang sesuai -->

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Detail Surat Keluar</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nomor Surat: <span class="text-primary">{{ $surat->nomor_surat }}</span></h5>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="card-text"><strong>Tanggal Surat:</strong> {{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d-m-Y') }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <p class="card-text"><strong>Status Validasi:</strong> {{ $surat->status_validasi }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="card-text"><strong>Perihal:</strong> {{ $surat->perihal }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <p class="card-text"><strong>Tujuan Surat:</strong> {{ $surat->tujuan_surat }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="card-text"><strong>Disahkan Oleh:</strong> {{ $surat->disahkan_oleh ?? 'Belum ada' }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <p class="card-text"><strong>Jabatan Pengesah:</strong> {{ $surat->jabatan_pengesah ?? 'Belum ada' }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="card-text"><strong>Tembusan:</strong> {{ $surat->tembusan ?? 'Tidak ada tembusan' }}</p>
                </div>
                <div class="col-md-6 text-end">
                    @if($surat->lampiran)
                        <p class="card-text"><strong>Lampiran:</strong> 
                            <a href="{{ asset('path/to/lampiran/' . $surat->lampiran) }}" target="_blank" class="btn btn-info btn-sm">Lihat Lampiran</a>
                        </p>
                    @else
                        <p class="card-text"><strong>Lampiran:</strong> Tidak ada lampiran</p>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <p class="card-text"><strong>Isi Surat:</strong></p>
                    <div class="border p-3 mb-3" style="background-color: #f8f9fa;">
                        {!! $surat->isi_surat !!}
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    @if($surat->foto_surat)
                        <p class="card-text"><strong>Foto Surat:</strong> 
                            <a href="{{ asset('path/to/foto_surat/' . $surat->foto_surat) }}" target="_blank" class="btn btn-info btn-sm">Lihat Foto Surat</a>
                        </p>
                    @else
                        <p class="card-text"><strong>Foto Surat:</strong> Tidak ada foto surat</p>
                    @endif
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('surat-keluar.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection