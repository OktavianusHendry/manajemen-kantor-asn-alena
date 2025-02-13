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
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h2 style="font-size: 2.0em;"><b>Tambah Surat Keluar</b></h2>
                            </div>
                            <hr />
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('surat_keluar.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="id">Nama Lengkap Pembuat Surat Keluar</label>
                                        <input type="text" id="name" class="form-control"
                                            value="{{ Auth::user()->name }}" disabled />
                                        <input type="hidden" name="id" value="{{ Auth::user()->id }}" />
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="tgl_surat_keluar">Tanggal Surat Keluar</label>
                                        <input type="date" name="tgl_surat_keluar" class="form-control" required>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label class="form-label" for="id_instansi">Kirim Surat ke-</label>
                                            <select name="id_instansi" id="id_instansi" class="form-control" required>
                                                <option value="">--Pilih Instansi--</option>
                                                @foreach ($instansi as $d)
                                                    <option value="{{ $d->id_instansi }}">{{ $d->nama_instansi }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="form-label" for="id_tujuan">Tujuan Surat</label>
                                            <select name="id_tujuan" id="id_tujuan" class="form-control" required>
                                                <option value="">--Pilih Tujuan--</option>
                                                @foreach ($tujuan as $t)
                                                    <option value="{{ $t->id_tujuan }}">{{ $t->nama_tujuan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="sifat_surat_keluar">Sifat Surat</label>
                                        <div class="form-check">
                                            <input name="sifat_surat_keluar" class="form-check-input" type="radio"
                                                value="Formal" id="sifatSuratFormal" required />
                                            <label class="form-check-label" for="sifatSuratFormal">Formal</label>
                                        </div>
                                        <div class="form-check">
                                            <input name="sifat_surat_keluar" class="form-check-input" type="radio"
                                                value="Bisnis" id="sifatSuratBisnis" required />
                                            <label class="form-check-label" for="sifatSuratBisnis">Bisnis</label>
                                        </div>
                                        <div class="form-check">
                                            <input name="sifat_surat_keluar" class="form-check-input" type="radio"
                                                value="Resmi" id="sifatSuratResmi" required />
                                            <label class="form-check-label" for="sifatSuratResmi">Resmi</label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="basic-icon-default-fullname"
                                            for="perihal_surat">Perihal</label>
                                        <input type="text" name="perihal_surat" class="form-control" maxlength="100"
                                            required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="tindak_lanjut">Tindak Lanjut</label>
                                        <input type="text" name="tindak_lanjut" class="form-control" maxlength="100"
                                            required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="file_surat">File Dokumen (PDF, DOCX | max:
                                            10MB)</label>
                                        <input class="form-control" type="file" name="file_surat" id="file_surat" />
                                    </div>

                                    <input type="hidden" name="status_surat" value="Pending">

                                    <input type="hidden" name="catatan_surat" value=" ">

                                    <div class="form-group mt-4">
                                        <button type="submit" class="btn btn-primary">Tambah Surat Keluar</button>
                                        <a href="{{ route('surat_keluar.index') }}" class="btn btn-secondary">Kembali</a>
                                    </div>
                            </form>
                        @endsection
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>

</html>
