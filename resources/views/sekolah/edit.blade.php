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
                                    <h2 style="font-size: 2.0em;"><b>Edit Sekolah</b></h2>
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

                                <form action="{{ route('sekolah.update', $sekolah->id_sekolah) }}" method="POST"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <hr>
                                    <input type="hidden" name="_method" value="put" />

                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="nama_sekolah">Nama sekolah</label>
                                            <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control"
                                                value="{{ old('nama_sekolah', $sekolah->nama_sekolah) }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="alamat_sekolah">Alamat</label>
                                            <input type="text" name="alamat_sekolah" id="alamat_sekolah"
                                                class="form-control"
                                                value="{{ old('alamat_sekolah', $sekolah->alamat_sekolah) }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="no_telp">No. Telepon</label>
                                            <input type="text" name="no_telp" id="no_telp" class="form-control"
                                                value="{{ old('no_telp', $sekolah->no_telp) }}" required
                                                pattern="[0-9]{1,14}" maxlength="14">
                                        </div>


                                        <div class="form-group mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                value="{{ old('email', $sekolah->email) }}" required>
                                        </div>

                                        <br>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        <a href="{{ route('sekolah.index') }}" class="btn btn-secondary">Kembali</a>
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
