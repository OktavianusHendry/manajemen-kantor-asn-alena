@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 style="font-size: 2.0em;"><b>Edit Surat Keluar</b></h2>
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

                    <form action="{{ route('surat_keluar.update', $surat_keluar->id_surat_keluar) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="form-group mb-3">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="user_name">User</label>
                                    <input type="text" name="user_name" id="user_name" class="form-control"
                                        value="{{ $surat_keluar->users->name }}" disabled>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="tgl_surat_keluar">Tanggal Surat Masuk</label>
                                <input type="date" name="tgl_surat_keluar" class="form-control"
                                    value="{{ old('tgl_surat_keluar', $surat_keluar->tgl_surat_keluar) }}" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="id_instansi">Kirim Surat ke-</label>
                                    <select name="id_instansi" id="id_instansi" class="form-control" required>
                                        <option value="">--Pilih Instansi--</option>
                                        @foreach ($instansi as $d)
                                            <option value="{{ $d->id_instansi }}"
                                                {{ $d->id_instansi == old('id_instansi', $surat_keluar->id_instansi) ? 'selected' : '' }}>
                                                {{ $d->nama_instansi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="id_tujuan">Tujuan Surat</label>
                                    <select name="id_tujuan" id="id_tujuan" class="form-control" required>
                                        <option value="">--Pilih Tujuan--</option>
                                        @foreach ($tujuan as $t)
                                            <option value="{{ $t->id_tujuan }}"
                                                {{ $t->id_tujuan == old('id_tujuan', $surat_keluar->id_tujuan) ? 'selected' : '' }}>
                                                {{ $t->nama_tujuan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="sifatSurat">Sifat Surat</label>

                                <div class="form-check">
                                    <input name="sifat_surat_keluar" class="form-check-input" type="radio" value="Formal"
                                        id="sifatSuratFormal"
                                        {{ old('sifat_surat_keluar', $surat_keluar->sifat_surat_keluar) == 'Formal' ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sifatSuratFormal">Formal</label>
                                </div>

                                <div class="form-check">
                                    <input name="sifat_surat_keluar" class="form-check-input" type="radio" value="Bisnis"
                                        id="sifatSuratBisnis"
                                        {{ old('sifat_surat_keluar', $surat_keluar->sifat_surat_keluar) == 'Bisnis' ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sifatSuratBisnis">Bisnis</label>
                                </div>

                                <div class="form-check">
                                    <input name="sifat_surat_keluar" class="form-check-input" type="radio" value="Resmi"
                                        id="sifatSuratResmi"
                                        {{ old('sifat_surat_keluar', $surat_keluar->sifat_surat_keluar) == 'Resmi' ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sifatSuratResmi">Resmi</label>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="perihal">Perihal</label>
                                <input type="text" name="perihal" class="form-control" maxlength="100"
                                    value="{{ old('perihal', $surat_keluar->perihal_surat) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="tindak_lanjut">Tindak Lanjut</label>
                                <input type="text" name="tindak_lanjut" class="form-control" maxlength="50"
                                    value="{{ old('tindak_lanjut', $surat_keluar->tindak_lanjut) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="file_surat">File Dokumen (PDF, PPTX, DOC, DOCX, ZIP, RAR |
                                    max: 10MB)</label>
                                <input class="form-control" type="file" name="file_surat" id="file_surat" />
                                @if ($surat_keluar->file_surat)
                                    <p>Dokumen saat ini: <a href="{{ asset('storage/' . $surat_keluar->file_surat) }}"
                                            target="_blank">Lihat Dokumen</a></p>
                                @endif
                            </div>

                            @if (Auth::user()->role_as == '1')
                                <div class="form-group mb-3">
                                    <label class="form-label" for="status_surat">Status Surat</label><br>
                                    <input type="radio" id="Pending" name="status_surat" value="Pending"
                                        {{ $surat_keluar->status_surat == 'Pending' ? 'checked' : '' }}>
                                    <label class="form-label" for="Pending">Pending</label><br>

                                    <input type="radio" id="Approved" name="status_surat" value="Approved"
                                        {{ $surat_keluar->status_surat == 'Approved' ? 'checked' : '' }}>
                                    <label class="form-label" for="Approved">Approved</label><br>

                                    <input type="radio" id="Rejected" name="status_surat" value="Rejected"
                                        {{ $surat_keluar->status_surat == 'Rejected' ? 'checked' : '' }}>
                                    <label class="form-label" for="Rejected">Rejected</label>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="catatan_surat">Catatan</label>
                                    <input type="text" name="catatan_surat" class="form-control" maxlength="100"
                                        value="{{ old('catatan_surat', $surat_keluar->catatan_surat) }}" required>
                                </div>
                            @else
                                <input type="hidden" name="status_surat" value="Pending">
                            @endif

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Update Surat Keluar</button>
                                <a href="{{ route('surat_keluar.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
