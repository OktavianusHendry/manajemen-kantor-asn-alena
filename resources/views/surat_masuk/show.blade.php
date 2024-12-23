@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Detail</b>
                        <span class="text-muted fw-light">/ Info Surat Masuk</span>
                    </h2>
                </div>

                <div class="col-md">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <p class="text-large">Tanggal Surat Masuk:</p>
                                    <b>{{ $suratMasuk->tgl_surat_masuk }}</b></p>
                                    <hr />
                                    <p class="text-large">Asal Surat:</p>
                                    <b>{{ $suratMasuk->instansi->nama_instansi }}</b></p>
                                    <hr />
                                    <p class="text-large">Sifat Surat:</p>
                                    <b>{{ $suratMasuk->sifat_surat }}</b></p>
                                    <hr />
                                    <p class="text-large">Perihal:</p>
                                    <b>{{ $suratMasuk->perihal }}</b></p>
                                    <hr />
                                    <p class="text-large">Tindak Lanjut:</p>
                                    <b>{{ $suratMasuk->tindak_lanjut }}</b></p>
                                    <hr />
                                    <p class="text-large">Catatan:</p>
                                    <b>{{ $suratMasuk->catatan }}</b></p>
                                    <hr />
                                    <p class="text-large">File Surat Masuk:</p>
                                    <b>
                                        @if ($suratMasuk->file_surat)
                                            <!-- Check if file_surat exists -->
                                            <a href="{{ asset('storage/' . $suratMasuk->file_surat) }}" target="_blank"
                                                class="btn btn-success btn-sm">Lihat</a>&nbsp;&nbsp;
                                        @else
                                            Tidak ada dokumen
                                        @endif
                                    </b></p>
                                    <p class="card-text text-muted spacing">Ditambahkan pada
                                        {{ $suratMasuk->created_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}
                                    </p>
                                    <p class="card-text text-muted spacing">Terakhir diperbarui
                                        {{ $suratMasuk->updated_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}
                                    </p>
                                    <p>
                                        <a href="{{ route('surat_masuk.index') }}" class="btn btn-warning">Kembali</a>
                                        <a href="{{ route('surat_masuk.edit', $suratMasuk->id_surat_masuk) }}"
                                            class="btn btn-info">Edit</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img class="card-img card-img-right" src="../assets/img/elements/component-1.png"
                                    alt="Card image" />
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
</style>
