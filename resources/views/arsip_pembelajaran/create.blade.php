@extends(Auth::user()->role_as == '0' ? 'layoutsss.template' : 'layoutss.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 style="font-size: 2.0em;"><b>Tambah Pembelajaran Baru</b></h2>
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

                    <form action="{{ route('arsip_pembelajaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label class="form-label" for="judul_pembelajaran">Judul Pembelajaran</label>
                                <input type="text" name="judul_pembelajaran" class="form-control" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label class="form-label" for="id_jenjang">Jenjang</label>
                                    <select name="id_jenjang" id="id_jenjang" class="form-control" required>
                                        <option value="">--Pilih jenjang--</option>
                                        @foreach ($jenjang as $d)
                                            <option value="{{ $d->id_jenjang }}">{{ $d->nama_jenjang }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <label class="form-label" for="kelas">Kelas</label>
                                    <input type="text" name="kelas" class="form-control" required>
                                </div>

                                <div class="col-sm-4">
                                    <label class="form-label" for="pertemuan_ke">Pertemuan Ke-</label>
                                    <input type="text" name="pertemuan_ke" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="id_kategori">Kategori</label>
                                    <select name="id_kategori" id="id_kategori" class="form-control" required>
                                        <option value="">--Pilih Kategori--</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="id_sub_kategori">Sub Kategori</label>
                                    <select name="id_sub_kategori" id="id_sub_kategori" class="form-control" required>
                                        <option value="">--Pilih Sub Kategori--</option>
                                        @foreach ($subkategori as $s)
                                            <option value="{{ $s->id_sub_kategori }}">{{ $s->nama_sub_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Bagian Input File -->
                            <div id="file-input-container" class="form-group mb-3">
                                <label class="form-label" for="file_satu">File Pembelajaran 1 (ZIP, RAR, PDF, DOCX, DOC,
                                    SB3 | max: 30MB)</label>
                                <input class="form-control" type="file" name="file_satu" id="file_satu" />
                            </div>
                            <button type="button" id="addFileBtn" class="btn btn-primary">
                                <i class="menu-icon tf-icons bx bxs-plus-circle"></i> Tambah File
                            </button>

                            <div class="form-group mb-3 mt-3">
                                <label class="form-label" for="catatan">Catatan</label>
                                <input type="text" name="catatan" class="form-control" required>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Tambah Pembelajaran</button>
                                <a href="{{ route('arsip_pembelajaran.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Menambahkan Input File -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let fileInputContainer = document.getElementById('file-input-container');
            let addFileBtn = document.getElementById('addFileBtn');
            let fileCount = 1;

            addFileBtn.addEventListener('click', function() {
                fileCount++;
                if (fileCount <= 5) { // Batasi maksimal 5 file
                    let newFileInput = document.createElement('div');
                    newFileInput.classList.add('form-group', 'mb-3');
                    newFileInput.innerHTML = `
                        <label class="form-label" for="file_${fileCount}">File Pembelajaran ${fileCount} (ZIP, RAR, PDF, DOCX, DOC, PPT, SB3, XLSX | max: 30MB)</label>
                        <input class="form-control" type="file" name="file_${fileCount}" id="file_${fileCount}" />
                    `;
                    fileInputContainer.appendChild(newFileInput);

                    if (fileCount === 5) {
                        addFileBtn.style.display = 'none'; // Sembunyikan tombol jika mencapai 5 file
                    }
                }
            });
        });
    </script>
@endsection
