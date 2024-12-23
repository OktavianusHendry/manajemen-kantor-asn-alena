@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h2 style="font-size: 2.0em;"><b>Edit Surat Masuk</b></h2>
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

                        <form action="{{ route('surat_masuk.update', $suratMasuk->id_surat_masuk) }}" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put" />

                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="tgl_surat_masuk">Tanggal Surat Masuk</label>
                                    <input type="date" name="tgl_surat_masuk" class="form-control"
                                        value="{{ old('tgl_surat_masuk', $suratMasuk->tgl_surat_masuk) }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="id_instansi">Asal Surat</label>
                                    <select name="id_instansi" id="id_instansi" class="form-control">
                                        <option value="">--Pilih Instansi--</option>
                                        @foreach ($instansi as $d)
                                            <option value="{{ $d->id_instansi }}"
                                                {{ $d->id_instansi == old('id_instansi', $suratMasuk->id_instansi) ? 'selected' : '' }}>
                                                {{ $d->nama_instansi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="sifatSurat">Sifat Surat</label>
                                    <div class="form-check">
                                        <input name="sifat_surat" class="form-check-input" type="radio" value="Formal"
                                            id="sifatSuratFormal"
                                            {{ old('sifat_surat', $suratMasuk->sifat_surat) == 'Formal' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="sifatSuratFormal">Formal</label>
                                    </div>
                                    <div class="form-check">
                                        <input name="sifat_surat" class="form-check-input" type="radio" value="Bisnis"
                                            id="sifatSuratBisnis"
                                            {{ old('sifat_surat', $suratMasuk->sifat_surat) == 'Bisnis' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="sifatSuratBisnis">Bisnis</label>
                                    </div>
                                    <div class="form-check">
                                        <input name="sifat_surat" class="form-check-input" type="radio" value="Resmi"
                                            id="sifatSuratResmi"
                                            {{ old('sifat_surat', $suratMasuk->sifat_surat) == 'Resmi' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="sifatSuratResmi">Resmi</label>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="perihal">Perihal</label>
                                    <input type="text" name="perihal" class="form-control" maxlength="100"
                                        value="{{ old('perihal', $suratMasuk->perihal) }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="tindak_lanjut">Tindak Lanjut</label>
                                    <input type="text" name="tindak_lanjut" class="form-control" maxlength="50"
                                        value="{{ old('tindak_lanjut', $suratMasuk->tindak_lanjut) }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="file_surat">File Dokumen (PDF, PPTX, DOC, DOCX, ZIP, RAR
                                        | max: 10MB)</label>
                                    <input class="form-control" type="file" name="file_surat" id="file_surat" />
                                    @if ($suratMasuk->file_surat)
                                        <p>Dokumen saat ini: <a href="{{ asset('storage/' . $suratMasuk->file_surat) }}"
                                                target="_blank">Lihat
                                                Dokumen</a></p>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="catatan">Catatan</label>
                                    <input type="text" name="catatan" class="form-control" maxlength="100"
                                        value="{{ old('catatan', $suratMasuk->catatan) }}" required>
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">Update Surat Masuk</button>
                                    <a href="{{ route('surat_masuk.index') }}" class="btn btn-secondary">Kembali</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
