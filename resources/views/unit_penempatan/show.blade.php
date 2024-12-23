@extends('layouts.template')

@section('content')
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <!-- Detail Karyawan Section -->
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                Detail Data Unit Penempatan
                            </div>
                            <br>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label class="form-label"><strong>Nama Mentor:</strong></label>
                                            <p>{{ $unitPenempatan->user->name }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label"><strong>Mentoring di Sekolah:</strong></label>
                                            <p>{{ $unitPenempatan->sekolah->nama_sekolah }}</p>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- Informasi Kategori dan Sub Kategori -->
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label class="form-label"><strong>Kategori:</strong></label>
                                            <p>{{ $unitPenempatan->kategori->nama_kategori }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label"><strong>Sub Kategori:</strong></label>
                                            <p>{{ $unitPenempatan->sub_kategori->nama_sub_kategori }}</p>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- Informasi Kelas dan Jumlah Anak -->
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label class="form-label"><strong>Mengajar di Kelas:</strong></label>
                                            <p>{{ $unitPenempatan->kelas }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label"><strong>Jumlah Anak yang diajar:</strong></label>
                                            <p>{{ $unitPenempatan->jumlah_anak }}</p>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- Informasi Jumlah Pertemuan -->
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label class="form-label"><strong>Jumlah Pertemuan:</strong></label>
                                            <p>{{ $unitPenempatan->jumlah_pertemuan }}</p>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- Informasi Sampai Tanggal -->
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label class="form-label"><strong>Lama Mentoring (Mulai
                                                    Tanggal):</strong></label>
                                            <p>{{ $unitPenempatan->mulai_tanggal }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label"><strong>Sampai Tanggal:</strong></label>
                                            <p>{{ $unitPenempatan->sampai_tanggal }}</p>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- Informasi Detail / Info Lainnya -->
                                    <div class="form-group mb-3">
                                        <label class="form-label"><strong>Detail / Info Lainnya:</strong></label>
                                        <p class="detail-paragraph">{{ $unitPenempatan->detail }}</p>
                                    </div>

                                    <hr>

                                    <div class="form-group mb-3">
                                        <!-- Tombol Kembali -->
                                        <a href="{{ route('unit_penempatan.index') }}"
                                            class="btn btn-secondary">Kembali</a>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Foto Pegawai Section -->
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header bg-success text-white">
                                Foto
                            </div>
                            <div class="card-body text-center mt-3">
                                <img class="img-fluid mb-3"
                                    src="{{ asset('storage/' . $unitPenempatan->user->foto_diri) }}" alt="Foto Diri">
                                <p>{{ $unitPenempatan->user->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

<style>
    .table th,
    .table td {
        border-top: none;
    }

    .detail-paragraph {
        display: -webkit-box;
        -webkit-line-clamp: 4;
        /* Tentukan jumlah baris yang diinginkan */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: normal;
        max-height: calc(1.5em * 4);
        /* 1.5em adalah tinggi baris yang diasumsikan, 4 adalah jumlah baris */
    }

    .card-header {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .card-body p {
        margin-bottom: 0.5rem;
    }
</style>
