@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Detail</b>
                        <span class="text-muted fw-light">/ Info Berita Acara</span>
                    </h2>
                </div>

                <div class="col-md">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h3 class="card-title"><strong>{{ $berita->judul_berita }}</strong></h3>
                                    <p class="text-large">Isi Berita:</p>
                                    <b></b>{{ $berita->isi_berita }}</p>
                                    <p class="text-large">File:</p>
                                    <b>
                                        @if ($berita->file)
                                            <p>
                                                <a href="{{ Storage::url($berita->file) }}" target="_blank"
                                                    class="btn btn-primary">Lihat File</a>
                                            </p>
                                        @endif
                                    </b></p>
                                    <p class="card-text text-muted spacing">
                                        Terakhir diperbarui
                                        @if ($berita->updated_at)
                                            {{ $berita->updated_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}
                                        @else
                                            Tidak ada data pembaruan
                                        @endif
                                    </p>

                                    <p>
                                        <a href="{{ route('berita_acara.edit', $berita->id_berita) }}"
                                            class="btn btn-info">Edit</a>
                                        <a href="{{ route('berita_acara.index') }}" class="btn btn-warning">Kembali</a>
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
        </main>
    </div>
@endsection

<style>
    .card-header {
        background-color: #007bff;
        color: white;
        padding: 1.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-footer {
        background-color: #f8f9fa;
        padding: 1rem;
        text-align: right;
    }

    .card-title {
        font-size: 1.75rem;
        margin-bottom: 1rem;
        color: #ffab00;
    }

    .text-large {
        font-size: 1.10rem;
        margin-bottom: 0.5rem;
    }

    .card-text {
        text-align: justify;
    }

    .spacing {
        margin-bottom: 0.3rem;
    }

    .btn {
        margin: 0.5rem;
    }
</style>
