@extends('layouts.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h2 style="font-size: 2.0em;"><b>Edit Data Unit Penempatan</b></h2>
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

                        <form action="{{ route('unit_penempatan.update', $unitPenempatan->id) }}" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}



                            <div class="card-body">
                                <!-- Mentor and School Selection -->
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="id">Nama Mentor</label>
                                        <select name="id" id="id" class="form-control">
                                            @foreach ($users as $u)
                                                <option value="{{ $u->id }}"
                                                    {{ $unitPenempatan->id == $u->id ? 'selected' : '' }}>
                                                    {{ $u->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label" for="id_sekolah">Mentoring di</label>
                                        <select name="id_sekolah" id="id_sekolah" class="form-control">
                                            @foreach ($sekolas as $s)
                                                <option value="{{ $s->id }}"
                                                    {{ $unitPenempatan->sekolah_id == $s->id ? 'selected' : '' }}>
                                                    {{ $s->nama_sekolah }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Category and Sub-Category Selection -->
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="id_kategori">Kategori</label>
                                        <select name="id_kategori" id="id_kategori" class="form-control">
                                            @foreach ($kategoris as $k)
                                                <option value="{{ $k->id }}"
                                                    {{ $unitPenempatan->id_kategori == $k->id ? 'selected' : '' }}>
                                                    {{ $k->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label" for="id_sub_kategori">Sub Kategori</label>
                                        <select name="id_sub_kategori" id="id_sub_kategori" class="form-control">
                                            @foreach ($sub_kategoris as $t)
                                                <option value="{{ $t->id }}"
                                                    {{ $unitPenempatan->id_sub_kategori == $t->id ? 'selected' : '' }}>
                                                    {{ $t->nama_sub_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <!-- Class and Number of Children -->
                                <div class="form-group mb-3">
                                    <label class="form-label" for="kelas">Mengajar di Kelas</label>
                                    <input type="text" name="kelas" id="kelas" class="form-control"
                                        value="{{ old('kelas', $unitPenempatan->kelas) }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="jumlah_anak">Jumlah Anak yang diajar</label>
                                    <input type="number" name="jumlah_anak" id="jumlah_anak" class="form-control"
                                        value="{{ old('jumlah_anak', $unitPenempatan->jumlah_anak) }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="jumlah_pertemuan">Jumlah Pertemuan (Tahunan)</label>
                                    <input type="number" name="jumlah_pertemuan" id="jumlah_pertemuan" class="form-control"
                                        value="{{ old('jumlah_pertemuan', $unitPenempatan->jumlah_pertemuan) }}" required>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="mulai_tanggal">Lama Mentoring (Mulai Tanggal)</label>
                                        <input type="date" name="mulai_tanggal" id="mulai_tanggal" class="form-control"
                                            value="{{ old('mulai_tanggal', $unitPenempatan->mulai_tanggal) }}" required>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label" for="sampai_tanggal">Sampai Tanggal</label>
                                        <input type="date" name="sampai_tanggal" id="sampai_tanggal" class="form-control"
                                            value="{{ old('sampai_tanggal', $unitPenempatan->sampai_tanggal) }}" required>
                                    </div>
                                </div>



                                <!-- Additional Details -->
                                <div class="form-group mb-3">
                                    <label class="form-label" for="detail">Detail / Info Lainnya</label>
                                    <textarea name="detail" id="detail" class="form-control" maxlength="100" oninput="updateCharacterCount()">{{ old('detail', $unitPenempatan->detail) }}</textarea>
                                    <small id="charCount" class="form-text text-muted">100 karakter tersisa</small>
                                </div>

                                <script>
                                    function updateCharacterCount() {
                                        const textarea = document.getElementById('detail');
                                        const charCount = document.getElementById('charCount');
                                        const remaining = 100 - textarea.value.length;
                                        charCount.textContent = `${remaining} karakter tersisa`;
                                    }
                                </script>



                                <!-- Submit and Back Buttons -->
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('unit_penempatan.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
