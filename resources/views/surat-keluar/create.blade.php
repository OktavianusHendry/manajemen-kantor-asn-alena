@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')
@section('content')
    <div id="app">
        <div class="container-xxl flex-grow-1 container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">Tambah Surat Keluar</h2>
                </div>
                <div class="card mb-4">
                    <div class="container">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('surat-keluar.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}" required>
                                @error('nomor_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                                <input type="date" class="form-control @error('tanggal_surat') is-invalid @enderror" id="tanggal_surat" name="tanggal_surat" value="{{ old('tanggal_surat') }}" required>
                                @error('tanggal_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="perihal" class="form-label">Perihal</label>
                                <input type="text" class="form-control @error('perihal') is-invalid @enderror" id="perihal" name="perihal" value="{{ old('perihal') }}" required>
                                @error('perihal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tujuan_surat" class="form-label">Tujuan Surat</label>
                                <input type="text" class="form-control @error('tujuan_surat') is-invalid @enderror" id="tujuan_surat" name="tujuan_surat" value="{{ old('tujuan_surat') }}" required>
                                @error('tujuan_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status_validasi" class="form-label">Status Validasi</label>
                                <input type="text" class="form-control @error('status_validasi') is-invalid @enderror" id="status_validasi" name="status_validasi" value="{{ old('status_validasi') }}" required>
                                @error('status_validasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="lampiran" class="form-label">Lampiran (PDF, JPG, PNG)</label>
                                <input type="file" class="form-control @error('lampiran') is-invalid @enderror" id="lampiran" name="lampiran">
                                @error('lampiran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="foto_surat" class="form-label">Foto Surat (JPG, PNG)</label>
                                <input type="file" class="form-control @error('foto_surat') is-invalid @enderror" id="foto_surat" name="foto_surat">
                                @error('foto_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="isi_surat" class="form-label">Isi Surat</label>
                                <textarea class="form-control @error('isi_surat') is-invalid @enderror" id="isi_surat" name="isi_surat" rows="5" required>{{ old('isi_surat') }}</textarea>
                                @error('isi_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('surat-keluar.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    @section('scripts')
        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('isi_surat');
        </script>
    @endsection
@endsection