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
                                    <h2 style="font-size: 2.0em;"><b>Edit Instansi</b></h2>
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

                                <form action="{{ route('instansi.update', $instansi->id_instansi) }}" method="POST"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <hr>
                                    <input type="hidden" name="_method" value="put" />

                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="nama_instansi">Nama instansi</label>
                                            <input type="text" name="nama_instansi" id="nama_instansi"
                                                class="form-control"
                                                value="{{ old('nama_instansi', $instansi->nama_instansi) }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="id_tujuan">Jenis tujuan</label>
                                            <select name="id_tujuan" id="id_tujuan" class="form-control">
                                                @foreach ($tujuans as $tujuan)
                                                    <option value="{{ $tujuan->id_tujuan }}"
                                                        {{ $tujuan->id_tujuan == $instansi->id_tujuan ? 'selected' : '' }}>
                                                        {{ $tujuan->nama_tujuan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="alamat">Alamat</label>
                                            <input type="text" name="alamat" id="alamat" class="form-control"
                                                value="{{ old('alamat', $instansi->alamat) }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="no_telepon">No. Telepon</label>
                                            <input type="text" name="no_telepon" id="no_telepon" class="form-control"
                                                value="{{ old('no_telepon', $instansi->no_telepon) }}" required
                                                pattern="[0-9]{1,14}" maxlength="14">
                                        </div>


                                        <div class="form-group mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                value="{{ old('email', $instansi->email) }}" required>
                                        </div>

                                        <br>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        <a href="{{ route('instansi.index') }}" class="btn btn-secondary">Kembali</a>
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
