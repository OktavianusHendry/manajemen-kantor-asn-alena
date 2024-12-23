@extends('layouts.template')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            .image-preview {
                width: 276px;
                height: 148px;
                border: 2px solid #dddddd;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
                color: #cccccc;
                margin-bottom: 10px;
                overflow: hidden;
                position: relative;
            }

            .image-preview__image {
                display: none;
                width: 100%;
                height: auto;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        </style>
    </head>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 style="font-size: 2.0em;"><b>Edit Data User</b></h2>
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

                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <hr>
                        <input type="hidden" name="_method" value="put" />

                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label class="form-label" for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $user->name }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="role_as">Role</label>
                                <select name="role_as" id="role_as" class="form-control">
                                    <option value="1" {{ old('role_as', $user->role_as) == '1' ? 'selected' : '' }}>
                                        Admin</option>
                                    <option value="2" {{ old('role_as', $user->role_as) == '2' ? 'selected' : '' }}>
                                        Karyawan</option>
                                    <option value="0" {{ old('role_as', $user->role_as) == '0' ? 'selected' : '' }}>
                                        Mentor</option>
                                </select>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="foto_diri">Foto Diri *Formal (JPG/PNG | max:
                                        5MB)</label>
                                    <div class="image-preview" id="imagePreviewFotoDiri">
                                        <img src="{{ asset('storage/' . $user->foto_diri) }}" alt="Image Preview"
                                            class="image-preview__image" style="display: block;">
                                        <span class="image-preview__default-text" style="display: none;">Image
                                            Preview</span>
                                    </div>
                                    <input class="form-control" type="file" name="foto_diri" id="foto_diri"
                                        onchange="previewImage('foto_diri', 'imagePreviewFotoDiri')" />
                                    <button type="button" class="btn btn-secondary mt-2"
                                        onclick="showImageModal('imagePreviewFotoDiri')">Show Full
                                        Image</button>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="foto_ktp">Foto KTP *Formal (JPG/PNG | max:
                                        5MB)</label>
                                    <div class="image-preview" id="imagePreviewFotoKtp">
                                        <img src="{{ asset('storage/' . $user->foto_ktp) }}" alt="Image Preview"
                                            class="image-preview__image" style="display: block;">
                                        <span class="image-preview__default-text" style="display: none;">Image
                                            Preview</span>
                                    </div>
                                    <input class="form-control" type="file" name="foto_ktp" id="foto_ktp"
                                        onchange="previewImage('foto_ktp', 'imagePreviewFotoKtp')" />
                                    <button type="button" class="btn btn-secondary mt-2"
                                        onclick="showImageModal('imagePreviewFotoKtp')">Show Full Image</button>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="surat_tugas">Surat Tugas (PDF, PPTX, DOC, DOCX,
                                    ZIP, RAR | max: 10MB) <b>*Wajib untuk mentor</b></label>
                                <input class="form-control" type="file" name="surat_tugas" id="surat_tugas" />
                                @if ($user->surat_tugas)
                                    <p>Dokumen saat ini: <a href="{{ asset('storage/' . $user->surat_tugas) }}"
                                            target="_blank">Lihat
                                            Dokumen</a></p>
                                @endif
                            </div>

                            <div class="form-group
                                        mb-3">
                                <label class="form-label" for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" placeholder="Masukkan Alamat" class="form-control">{{ old('alamat', $user->alamat) }}</textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="id_jabatan">Jabatan</label>
                                    <select name="id_jabatan" id="id_jabatan" class="form-control">
                                        <option value="">--Pilih Jabatan--</option>
                                        @foreach ($jabatans as $jabatan)
                                            <option value="{{ $jabatan->id_jabatan }}"
                                                {{ $jabatan->id_jabatan == $user->id_jabatan ? 'selected' : '' }}>
                                                {{ $jabatan->nama_jabatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="id_divisi">Divisi</label>
                                    <select name="id_divisi" id="id_divisi" class="form-control">
                                        <option value="">--Pilih Divisi--</option>
                                        @foreach ($divisis as $divisi)
                                            <option value="{{ $divisi->id_divisi }}"
                                                {{ $divisi->id_divisi == $user->id_divisi ? 'selected' : '' }}>
                                                {{ $divisi->nama_divisi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="no_telepon">No. Telepon</label>
                                <input type="text" name="no_telepon" id="no_telepon" class="form-control"
                                    value="{{ old('no_telepon', $user->no_telepon) }}" pattern="[0-9]{1,14}"
                                    maxlength="14">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="tanggal_bergabung">Tanggal Bergabung</label>
                                <input type="date" class="form-control" id="tanggal_bergabung"
                                    name="tanggal_bergabung"
                                    value="{{ old('tanggal_bergabung', $user->tanggal_bergabung) }}">
                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Full Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="fullImage" src="" class="img-fluid" alt="Full Image">
                </div>
            </div>
        </div>
    </div>

    <style>
        .text-right-custom {
            text-align: right;
        }
    </style>

    <script>
        function previewImage(inputId, previewId) {
            const input = document.getElementById(inputId);
            const previewContainer = document.getElementById(previewId);
            const previewImage = previewContainer.querySelector(".image-preview__image");
            const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

            const file = input.files[0];
            const reader = new FileReader();

            if (file) {
                previewDefaultText.style.display = "none";
                previewImage.style.display = "block";

                reader.addEventListener("load", function() {
                    previewImage.setAttribute("src", this.result);
                });

                reader.readAsDataURL(file);
            } else {
                previewDefaultText.style.display = "block";
                previewImage.style.display = "none";
                previewImage.setAttribute("src", "");
            }
        }

        function showImageModal(previewId) {
            const previewContainer = document.getElementById(previewId);
            const previewImage = previewContainer.querySelector(".image-preview__image");
            const fullImage = document.getElementById("fullImage");

            if (previewImage.getAttribute("src") !== "") {
                fullImage.setAttribute("src", previewImage.getAttribute("src"));
                $('#imageModal').modal('show');
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>
@endsection
