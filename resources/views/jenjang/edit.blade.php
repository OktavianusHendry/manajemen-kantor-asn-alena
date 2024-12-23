@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')
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
                                    <h2 style="font-size: 2.0em;"><b>Edit Jenjang</b></h2>
                                </div>
                                <hr>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('jenjang.update', $jenjang->id_jenjang) }}" method="POST"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="put" />

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nama_jenjang">Nama jenjang</label>
                                            <input type="text" name="nama_jenjang" id="nama_jenjang" class="form-control"
                                                value="{{ old('nama_jenjang', $jenjang->nama_jenjang) }}" required>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        <a href="{{ route('jenjang.index') }}" class="btn btn-secondary">Kembali</a>
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
