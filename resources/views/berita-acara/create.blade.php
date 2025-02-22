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
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
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
                            <option value="karyawan">Karyawan</option>
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

        <button type="button" class="btn btn-primary" id="add-peserta">Tambah Peserta</button>
        <br><br>

        <button type="submit" class="btn btn-success">Simpan Berita Acara</button>
    </form>
</div>

<script>
    let pesertaIndex = 1;

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
                        <option value="karyawan">Karyawan</option>
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

    document.getElementById('peserta-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-peserta')) {
            e.target.closest('.peserta-group').remove();
        }
    });
</script>
@endsection
