@extends('layouts.template')

@section('content')
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Detail</b>
                        <span class="text-muted fw-light">/ Info sekolah</span>
                    </h2>
                </div>

                <div class="col-md">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h3 class="card-title"><strong>{{ $sekolah->nama_sekolah }}</strong></h3>
                                    <p class="text-large">Alamat&nbsp;&nbsp;&nbsp;:&nbsp;<br>
                                        <b>{{ $sekolah->alamat_sekolah }}</b>
                                    </p>
                                    <br>
                                    <p class="text-large">No. Telepon&nbsp;&nbsp;&nbsp;:&nbsp;<br>
                                        <b>{{ $sekolah->no_telp }}</b>
                                    </p>
                                    <br>
                                    <p class="text-large">Email&nbsp;&nbsp;&nbsp;:&nbsp;<br>
                                        <b>{{ $sekolah->email }}</b>
                                    </p>
                                    <br>
                                    <br>
                                    <p class="card-text text-muted spacing">Ditambahkan pada
                                        {{ $sekolah->created_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}
                                    </p>
                                    <p class="card-text text-muted spacing">Terakhir diperbarui
                                        {{ $sekolah->updated_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}
                                    </p>
                                    <p>
                                        <a href="{{ route('sekolah.edit', $sekolah->id_sekolah) }}"
                                            class="btn btn-info">Edit</a>
                                        <a href="{{ route('sekolah.index') }}" class="btn btn-warning">Kembali</a>
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
