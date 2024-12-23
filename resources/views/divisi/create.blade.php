@extends('layouts.template')
@section('content')

    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>{{ config('app.name', 'Laravel') }}</title>
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        </head>

        <body>
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-xl">
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h2 style="font-size: 2.0em;"><b>Tambah Divisi Baru</b></h2>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('divisi.store') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <hr>

                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="nama_divisi">Nama Divisi</label>
                                            <input type="text" name="nama_divisi" id="nama_divisi"
                                                placeholder="Masukkan Nama Divisi" class="form-control"
                                                value="{{ old('nama_divisi') }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="kode_divisi">Kode Divisi</label>
                                            <input type="text" name="kode_divisi" id="kode_divisi"
                                                placeholder="Masukkan Kode Divisi" class="form-control"
                                                value="{{ old('kode_divisi') }}" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('divisi.index') }}" class="btn btn-secondary">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </body>

    </html>
@endsection
