@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layouts.template')

@section('content')
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Detail</b>
                        <span class="text-muted fw-light">/ Info Surat Keluar</span>
                    </h2>
                </div>

                <div class="col-md">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <p class="text-large">Nama Pembuat Surat:</p>
                                    <b>{{ $surat_keluar->users->name }}</b>
                                    <!-- Menggunakan 'user' untuk mendapatkan nama pembuat surat -->
                                    <hr />
                                    <p class="text-large">Tanggal Surat Keluar:</p>
                                    <b>{{ $surat_keluar->tgl_surat_keluar }}</b>
                                    <hr />
                                    <p class="text-large">Asal Surat:</p>
                                    <b>{{ $surat_keluar->instansi->nama_instansi }}</b>
                                    <hr />
                                    <p class="text-large">Sifat Surat:</p>
                                    <b>{{ $surat_keluar->sifat_surat_keluar }}</b>
                                    <hr />
                                    <p class="text-large">Perihal:</p>
                                    <b>{{ $surat_keluar->perihal_surat }}</b>
                                    <hr />
                                    <p class="text-large">Tindak Lanjut:</p>
                                    <b>{{ $surat_keluar->tindak_lanjut }}</b>
                                    <hr />
                                    <p class="text-large">Status:</p>
                                    <b>{{ $surat_keluar->status_surat }}</b>
                                    <hr />
                                    @if ($surat_keluar->status_surat == 'Rejected')
                                        <p class="text-large">Catatan Perbaikan:</p>
                                        <b>{{ $surat_keluar->catatan_surat }}</b>
                                        <hr />
                                    @endif

                                    <p class="text-large">File Surat Keluar:</p>
                                    <b>
                                        @if ($surat_keluar->file_surat)
                                            <a href="{{ asset('storage/' . $surat_keluar->file_surat) }}" target="_blank"
                                                class="btn btn-success btn-sm">Lihat</a>&nbsp;&nbsp;
                                        @else
                                            Tidak ada dokumen
                                        @endif
                                    </b>
                                    <hr />

                                    <p class="card-text text-muted spacing">Ditambahkan pada
                                        {{ $surat_keluar->created_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}
                                    </p>
                                    <p class="card-text text-muted spacing">Terakhir diperbarui
                                        {{ $surat_keluar->updated_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}
                                    </p>

                                    <p>
                                        <a href="{{ route('surat_keluar.index') }}" class="btn btn-warning">Kembali</a>
                                        <a href="{{ route('surat_keluar.edit', $surat_keluar->id_surat_keluar) }}"
                                            class="btn btn-info">Edit</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img class="card-img card-img-right"
                                    src="{{ asset('assets/img/elements/component-1.png') }}" alt="Card image" />
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
