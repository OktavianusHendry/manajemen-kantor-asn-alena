@extends(Auth::user()->role_as == '0' ? 'layoutsss.template' : 'layoutss.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 style="font-size: 2.0em;"><b>Edit Pembelajaran</b></h2>
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

                    <form action="{{ route('arsip_pembelajaran.update', $arsip->id_arsip_pembelajaran) }}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put" />

                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label class="form-label" for="judul_pembelajaran">Judul Pembelajaran</label>
                                <input type="text" name="judul_pembelajaran" class="form-control"
                                    value="{{ $arsip->judul_pembelajaran }}" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="id_jenjang">Jenjang</label>
                                    <select name="id_jenjang" id="id_jenjang" class="form-control" required>
                                        <option value="">--Pilih jenjang--</option>
                                        @foreach ($jenjang as $d)
                                            <option value="{{ $d->id_jenjang }}"
                                                {{ $arsip->id_jenjang == $d->id_jenjang ? 'selected' : '' }}>
                                                {{ $d->nama_jenjang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="kelas">Kelas</label>
                                    <input type="text" name="kelas" class="form-control" value="{{ $arsip->kelas }}"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="id_kategori">Kategori</label>
                                    <select name="id_kategori" id="id_kategori" class="form-control" required>
                                        <option value="">--Pilih Kategori--</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id_kategori }}"
                                                {{ $arsip->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                                                {{ $k->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="id_sub_kategori">Sub Kategori</label>
                                    <select name="id_sub_kategori" id="id_sub_kategori" class="form-control" required>
                                        <option value="">--Pilih Sub Kategori--</option>
                                        @foreach ($subkategori as $s)
                                            <option value="{{ $s->id_sub_kategori }}"
                                                {{ $arsip->id_sub_kategori == $s->id_sub_kategori ? 'selected' : '' }}>
                                                {{ $s->nama_sub_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Bagian Input File -->
                            <div id="file-input-container" class="form-group mb-3">
                                <label class="form-label" for="file_satu">File Pembelajaran 1 (ZIP, RAR, PDF, DOCX, DOC, SB3
                                    | max: 30MB)</label>
                                <input class="form-control" type="file" name="file_satu" id="file_satu" />
                                @if ($arsip->file_satu)
                                    <p>File yang diunggah: <a href="{{ Storage::url($arsip->file_satu) }}"
                                            target="_blank">Lihat File</a></p>
                                @endif
                            </div>

                            <!-- Tambahan file jika ada -->
                            @foreach (['file_dua', 'file_tiga', 'file_empat', 'file_lima'] as $file)
                                <div class="form-group mb-3">
                                    <label class="form-label"
                                        for="{{ $file }}">{{ ucfirst(str_replace('_', ' ', $file)) }} (ZIP, RAR,
                                        PDF, DOCX, DOC, SB3 | max: 30MB)</label>
                                    <input class="form-control" type="file" name="{{ $file }}"
                                        id="{{ $file }}" />
                                    @if ($arsip->$file)
                                        <p>File yang diunggah: <a href="{{ Storage::url($arsip->$file) }}"
                                                target="_blank">Lihat File</a></p>
                                    @endif
                                </div>
                            @endforeach

                            <div class="form-group mb-3 mt-3">
                                <label class="form-label" for="catatan">Catatan</label>
                                <input type="text" name="catatan" class="form-control" value="{{ $arsip->catatan }}">
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Perbarui Pembelajaran</button>
                                <a href="{{ route('arsip_pembelajaran.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
