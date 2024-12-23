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
                                    <h2 style="font-size: 2.0em;"><b>Tambah File Berita Acara</b></h2>
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

                                <form action="{{ route('berita_acara.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <hr>

                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="judul_berita">Judul Berita</label>
                                            <input type="text" name="judul_berita" id="judul_berita" class="form-control"
                                                value="{{ old('judul_berita') }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="isi_berita">Isi Berita</label>
                                            <textarea name="isi_berita" id="isi_berita" class="form-control" required>{{ old('isi_berita') }}</textarea>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="file">File Berita Acara (PDF, PPTX, DOC,
                                                DOCX, ZIP, RAR | max:
                                                10MB)</label>
                                            <input type="file" name="file" id="file" class="form-control">
                                        </div>

                                        <br>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('berita_acara.index') }}" class="btn btn-secondary">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>

    </html>
@endsection
