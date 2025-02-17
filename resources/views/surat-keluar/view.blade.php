@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
<div id="app">
    <main class="py-4">
        <div class="container">
            <div class="d-flex justify-content-between mb-2">
                <h2 class="fw-bold py-3 mb-1">
                    <b>Detail Surat Keluar</b>
                    <span class="text-muted fw-light">/ Info Surat Keluar</span>
                </h2>
            </div>

            <div class="col-md">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="text-large">Tanggal Surat:</p>
                                <p>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d-m-Y') }}</p>
                                <hr />
                                <p class="text-large">Nomor Surat:</p>
                                <p>{{ $surat->nomor_surat }}</p>
                                <hr />
                                <p class="text-large">Tujuan Surat:</p>
                                <p>{{ $surat->tujuan_surat }}</p>
                                <hr />
                                <p class="text-large">Perihal:</p>
                                <p>{{ $surat->perihal }}</p>
                                <hr />
                                <p class="text-large">Isi Surat:</p>
                                <p>{!! $surat->isi_surat !!}</p>
                                <hr />
                                <p class="text-large">Lampiran:</p>
                                <p>
                                    @if ($surat->lampiran)
                                        <a href="{{ asset('storage/' . $surat->lampiran) }}" target="_blank" class="btn btn-success btn-sm">Lihat</a>
                                    @else
                                        Tidak ada dokumen
                                    @endif
                                </p>
                                <hr />
                                <p class="text-large">Status Validasi:</p>
                                <p>{{ $surat->status_validasi }}</p>
                                <hr />
                                <p class="text-large">Disahkan Oleh:</p>
                                <p>{{ $surat->disahkan_oleh ?? 'Belum ada' }}</p>
                                <hr />
                                <p class="text-large">Jabatan Pengesah:</p>
                                <p>{{ $surat->jabatan_pengesah ?? 'Belum ada' }}</p>
                                <hr />
                                <p class="text-large">Tembusan:</p>
                                <p>{{ $surat->tembusan ?? 'Tidak ada tembusan' }}</p>
                                <hr />
                                <p class="card-text text-muted spacing">Ditambahkan pada {{ $surat->created_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}</p>
                                <p class="card-text text-muted spacing">Terakhir diperbarui {{ $surat->updated_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}</p>
                                <p>
                                    <a href="{{ route('surat-keluar.index') }}" class="btn btn-warning">Kembali</a>
                                    <a href="{{ route('surat-keluar.edit', $surat->id_surat) }}" class="btn btn-info">Edit</a>
                                    @if (Auth::user()->role_as == '1' || Auth::user()->role_as == '2')
                                        @if ($surat->status_validasi == 'Disetujui') <!-- Ganti dengan status yang sesuai -->
                                            <a href="{{ route('surat-keluar.pdfasn', $surat->id_surat) }}" class="btn btn-success">Format ASN</a>
                                            <a href="{{ route('surat-keluar.pdfaa', $surat->id_surat) }}" class="btn btn-success">Format AA</a>
                                        @endif
                                    @endif
                                </p>
                            </div>
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

    .spacing {
        margin-top: 10px;
    }
</style>