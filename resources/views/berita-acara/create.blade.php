@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
<div class="container">
    <h2>Edit Berita Acara</h2>
    <form action="{{ route('berita-acara.update', $beritaAcara->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $beritaAcara->judul }}" required>
        </div>

        {{-- Deskripsi dengan CKEditor --}}
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3">{{ $beritaAcara->deskripsi }}</textarea>
        </div>

        {{-- Tanggal --}}
        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $beritaAcara->tanggal }}" required>
        </div>

        {{-- Berkas --}}
        <div class="mb-3">
            <label class="form-label">Berkas (Opsional)</label>
            <input type="file" name="berkas" class="form-control">
            @if($beritaAcara->berkas)
                <p>File saat ini: <a href="{{ asset('storage/' . $beritaAcara->berkas) }}" target="_blank">Lihat Berkas</a></p>
            @endif
        </div>

        {{-- Tautan Website --}}
        <div class="mb-3">
            <label class="form-label">Tautan Website (Opsional)</label>
            <input type="url" name="tautan_website" class="form-control" value="{{ $beritaAcara->tautan_website }}">
        </div>

        <hr>
        <h4>Peserta Berita Acara</h4>

        {{-- PESERTA INTERNAL --}}
        <h5>Peserta Internal</h5>
        <div id="peserta-internal-container">
            @foreach ($beritaAcara->peserta->where('jenis_peserta', 'karyawan') as $peserta)
                <div class="row">
                    <div class="col-md-5">
                        <label>Pilih Peserta Internal</label>
                        <select name="peserta_internal[]" class="form-control">
                            <option value="">-- Pilih Peserta --</option>
                            @foreach ($karyawan as $k)
                                <option value="{{ $k->id }}" {{ $peserta->id_user == $k->id ? 'selected' : '' }}>
                                    {{ $k->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-internal">X</button>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-primary" id="add-peserta-internal">Tambah Peserta Internal</button>

        <hr>

        {{-- PESERTA EKSTERNAL --}}
        <h5>Peserta Eksternal</h5>
        <div id="peserta-container">
            @foreach ($beritaAcara->peserta->where('jenis_peserta', 'luar') as $index => $peserta)
                <div class="peserta-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="peserta[{{ $index }}][nama_lengkap]" class="form-control" value="{{ $peserta->nama_lengkap }}" required>
                        </div>
                        <div class="col-md-3">
                            <label>Instansi</label>
                            <input type="text" name="peserta[{{ $index }}][instansi]" class="form-control" value="{{ $peserta->instansi }}">
                        </div>
                        <div class="col-md-3">
                            <label>Jabatan</label>
                            <input type="text" name="peserta[{{ $index }}][jabatan]" class="form-control" value="{{ $peserta->jabatan }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-peserta">X</button>
                        </div>
                    </div>
                    <hr>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-primary" id="add-peserta">Tambah Peserta Eksternal</button>

        <br><br>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('deskripsi');

    let pesertaIndex = {{ $beritaAcara->peserta->where('jenis_peserta', 'luar')->count() }};

    // Tambah Peserta Eksternal
    document.getElementById('add-peserta').addEventListener('click', function () {
        let container = document.getElementById('peserta-container');
        let newPeserta = document.createElement('div');
        newPeserta.classList.add('peserta-group');

        newPeserta.innerHTML = `
            <div class="row">
                <div class="col-md-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="peserta[${pesertaIndex}][nama_lengkap]" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label>Instansi</label>
                    <input type="text" name="peserta[${pesertaIndex}][instansi]" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Jabatan</label>
                    <input type="text" name="peserta[${pesertaIndex}][jabatan]" class="form-control">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-peserta">X</button>
                </div>
            </div>
            <hr>
        `;

        container.appendChild(newPeserta);
        pesertaIndex++;
    });

    // Hapus Peserta Eksternal
    document.getElementById('peserta-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-peserta')) {
            e.target.closest('.peserta-group').remove();
        }
    });

    // Tambah Peserta Internal
    document.getElementById('add-peserta-internal').addEventListener('click', function () {
        let container = document.getElementById('peserta-internal-container');
        let newSelect = document.createElement('div');
        newSelect.classList.add('row');

        newSelect.innerHTML = `
            <div class="col-md-5">
                <label>Pilih Peserta Internal</label>
                <select name="peserta_internal[]" class="form-control">
                    <option value="">-- Pilih Peserta --</option>
                    @foreach ($karyawan as $k)
                        <option value="{{ $k->id }}">{{ $k->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-internal">X</button>
            </div>
        `;

        container.appendChild(newSelect);
    });

    // Hapus Peserta Internal
    document.getElementById('peserta-internal-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-internal')) {
            e.target.closest('.row').remove();
        }
    });
</script>
@endsection
