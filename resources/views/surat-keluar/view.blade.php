@extends('layouts.template') <!-- Ganti dengan layout yang sesuai -->

@section('content')
<div class="container mt-5">
    <h2>Detail Surat Keluar</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nomor Surat: {{ $surat->nomor_surat }}</h5>
            <p class="card-text"><strong>Tanggal Surat:</strong> {{ $surat->tanggal_surat }}</p>
            <p class="card-text"><strong>Perihal:</strong> {{ $surat->perihal }}</p>
            <p class="card-text"><strong>Tujuan Surat:</strong> {{ $surat->tujuan_surat }}</p>
            <p class="card-text"><strong>Disahkan Oleh:</strong> {{ $surat->disahkan_oleh }}</p>
            <p class="card-text"><strong>Jabatan Pengesah:</strong> {{ $surat->jabatan_pengesah }}</p>
            <p class="card-text"><strong>Tembusan:</strong> {{ $surat->tembusan }}</p>
            <p class="card-text"><strong>Status Validasi:</strong> {{ $surat->status_validasi }}</p>
            <p class="card-text"><strong>Isi Surat:</strong></p>
            <div>{!! $surat->isi_surat !!}</div> <!-- Menggunakan {!! !!} untuk menampilkan HTML -->
            @if($surat->lampiran)
                <p class="card-text"><strong>Lampiran:</strong> <a href="{{ asset('path/to/lampiran/' . $surat->lampiran) }}" target="_blank">Lihat Lampiran</a></p>
            @endif
            @if($surat->foto_surat)
                <p class="card-text"><strong>Foto Surat:</strong> <a href="{{ asset('path/to/foto_surat/' . $surat->foto_surat) }}" target="_blank">Lihat Foto Surat</a></p>
            @endif
            <a href="{{ route('surat-keluar.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection