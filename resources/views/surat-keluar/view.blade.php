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
                                <b>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d-m-Y') }}</b>
                                <hr />
                                <p class="text-large">Nomor Surat:</p>
                                <b>{{ $surat->nomor_surat }}</b>
                                <hr />
                                <p class="text-large">Tujuan Surat:</p>
                                <b>{{ $surat->tujuan_surat }}</b>
                                <hr />
                                <p class="text-large">Perihal:</p>
                                <b>{{ $surat->perihal }}</b>
                                <hr />
                                <p class="text-large">Isi Surat:</p>
                                <b>{!! $surat->isi_surat !!}</b>
                                <hr />
                                <p class="text-large">Lampiran:</p>
                                <b>
                                    @if ($surat->lampiran)
                                        <a href="{{ asset('storage/' . $surat->lampiran) }}" target="_blank" class="btn btn-success btn-sm">Lihat</a>
                                    @else
                                        Tidak ada dokumen
                                    @endif
                                </b>
                                <hr />
                                <p class="text-large">Status Validasi:</p>
                                <b>{{ $surat->status_validasi }}</b>
                                <hr />
                                <p class="text-large">Disahkan Oleh:</p>
                                <b>{{ $surat->disahkan_oleh ?? 'Belum ada' }}</b>
                                <hr />
                                <p class="text-large">Jabatan Pengesah:</p>
                                <b>{{ $surat->jabatan_pengesah ?? 'Belum ada' }}</b>
                                <hr />
                                <p class="text-large">Tembusan:</p>
                                <b>{{ $surat->tembusan ?? 'Tidak ada tembusan' }}</b>
                                <hr />
                                <p class="card-text text-muted spacing">Ditambahkan pada {{ $surat->created_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}</p>
                                <p class="card-text text-muted spacing">Terakhir diperbarui {{ $surat->updated_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}</p>
                                <p>
                                    <a href="{{ route('surat-keluar.index') }}" class="btn btn-warning">Kembali</a>
                                    <a href="{{ route('surat-keluar.edit', $surat->id_surat) }}" class="btn btn-info">Edit</a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img class="card-img card-img-right" src="../assets/img/elements/component-1.png" alt="Card image" />
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
    }

    .card-body p {
        margin-bottom: 0.5rem;
    }

    .spacing {
        margin-top: 10px;
    }
</style>