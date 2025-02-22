@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
<div class="container">
    <h2>Buat Berita Acara Baru</h2>
    <form action="{{ route('berita-acara.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="editor" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Berkas (Opsional)</label>
            <input type="file" name="berkas" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Tautan Website (Opsional)</label>
            <input type="url" name="tautan_website" class="form-control">
        </div>

        <hr>
        <h4>Peserta Berita Acara</h4>

        {{-- PESERTA INTERNAL --}}
        <h5>Peserta Internal</h5>
        <div id="peserta-internal-container">
            <div class="row">
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
                    <button type="button" class="btn btn-primary" id="add-peserta-internal">Tambah</button>
                </div>
            </div>
            <hr>
        </div>

        {{-- PESERTA EKSTERNAL --}}
        <h5>Peserta Eksternal</h5>
        <div id="peserta-container">
            <div class="peserta-group">
                <div class="row">
                    <div class="col-md-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="peserta[0][nama_lengkap]" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label>Instansi</label>
                        <input type="text" name="peserta[0][instansi]" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Jabatan</label>
                        <input type="text" name="peserta[0][jabatan]" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label>Jenis Peserta</label>
                        <select name="peserta[0][jenis_peserta]" class="form-control" required>
                            <option value="luar">Luar</option>
                        </select>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-peserta">X</button>
                    </div>
                </div>
                <hr>
            </div>
        </div>

        <button type="button" class="btn btn-primary" id="add-peserta">Tambah Peserta Eksternal</button>
        <br><br>

        <button type="submit" class="btn btn-success">Simpan Berita Acara</button>
        </form>
        </div>

        <script>
            <!-- CKEditor -->
            <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
            <script>
                let editor;
                ClassicEditor
                    .create(document.querySelector('#editor'))
                    .then(newEditor => {
                        editor = newEditor;
                    })
                    .catch(error => {
                        console.error(error);
                    });

                document.querySelector('form').addEventListener('submit', (event) => {
                    document.querySelector('#editor').value = editor.getData();
                });
            </script>

            let pesertaIndex = 1;

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
                        <div class="col-md-2">
                            <label>Jenis Peserta</label>
                            <select name="peserta[${pesertaIndex}][jenis_peserta]" class="form-control" required>
                                <option value="luar">Luar</option>
                            </select>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
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

            // Tambah Peserta Internal (duplikat select dropdown)
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
