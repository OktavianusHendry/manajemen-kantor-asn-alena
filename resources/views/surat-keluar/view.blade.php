@extends('layouts.template') <!-- Ganti dengan layout yang sesuai -->

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Detail Surat Keluar</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nomor Surat: <span class="text-primary">{{ $surat->nomor_surat }}</span></h5>
            <p class="card-text"><strong>Tanggal Surat:</strong> {{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d-m-Y') }}</p>
            <p class="card-text"><strong>Perihal:</strong> {{ $surat->perihal }}</p>
            <p class="card-text"><strong>Tujuan Surat:</strong> {{ $surat->tujuan_surat }}</p>
            <p class="card-text"><strong>Disahkan Oleh:</strong> {{ $surat->disahkan_oleh }}</p>
            <p class="card-text"><strong>Jabatan Pengesah:</strong> {{ $surat->jabatan_pengesah }}</p>
            <p class="card-text"><strong>Tembusan:</strong> {{ $surat->tembusan }}</p>
            <p class="card-text"><strong>Status Validasi:</strong> {{ $surat->status_validasi }}</p>
            <p class="card-text"><strong>Isi Surat:</strong></p>
            <div class="border p-3 mb-3" style="background-color: #f8f9fa;">
                {!! $surat->isi_surat !!}
            </div>

            @if($surat->lampiran)
                <p class="card-text"><strong>Lampiran:</strong> 
                    <a href="{{ asset('path/to/lampiran/' . $surat->lampiran) }}" target="_blank" class="btn btn-info btn-sm">Lihat Lampiran</a>
                </p>
            @endif
            @if($surat->foto_surat)
                <p class="card-text"><strong>Foto Surat:</strong> 
                    <a href="{{ asset('path/to/foto_surat/' . $surat->foto_surat) }}" target="_blank" class="btn btn-info btn-sm">Lihat Foto Surat</a>
                </p>
            @endif
            <a href="{{ route('surat-keluar.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection