@extends(Auth::user()->role_as == '0' ? 'layoutsss.template' : 'layoutss.template')

@section('content')
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <!-- Detail Karyawan Section -->
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                Detail Data Arsip Pembelajaran
                            </div>
                            <br>
                            <div class="card-body">
                                <h3 class="card-title"><strong>{{ $arsip->judul_pembelajaran }}
                                        Pertemuan ke - {{ $arsip->pertemuan_ke }}</strong></h3>
                                <br>
                                <div class="table-responsive text-nowrap">
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label class="form-label"><strong>Jenjang Pendidikan:</strong></label>
                                            <p>{{ $arsip->jenjang->nama_jenjang }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label"><strong>Kelas:</strong></label>
                                            <p>{{ $arsip->kelas }}</p>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- Informasi Kategori dan Sub Kategori -->
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label class="form-label"><strong>Kategori:</strong></label>
                                            <p>{{ $arsip->kategori->nama_kategori }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label"><strong>Sub Kategori:</strong></label>
                                            <p>{{ $arsip->sub_kategori->nama_sub_kategori }}</p>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group mb-3">
                                        <!-- Tombol Kembali -->


                                        @if (Auth::user()->role_as == '2')
                                            <a href="{{ route('arsip_pembelajaran.index') }}"
                                                class="btn btn-secondary">Kembali</a>
                                        @else
                                            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Kembali</a>
                                        @endif
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header bg-success text-white">
                                File Modul dan Proyek
                            </div>
                            <br>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <!-- File Satu -->
                                            @if ($arsip->file_satu)
                                                <p>
                                                <div class="col-sm-12 mb-3">
                                                    <label class="form-label"><strong>File
                                                            Satu&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong></label>
                                                    <a href="{{ asset('storage/' . $arsip->file_satu) }}" target="_blank"
                                                        class="btn btn-success btn-sm">Unduh</a>
                                                </div>
                                                </p>
                                            @endif

                                            <!-- File Dua -->
                                            @if ($arsip->file_dua)
                                                <p>
                                                <div class="col-sm-12 mb-3">
                                                    <label class="form-label"><strong>File
                                                            Dua&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong></label>
                                                    <a href="{{ asset('storage/' . $arsip->file_dua) }}" target="_blank"
                                                        class="btn btn-success btn-sm">Unduh</a>
                                                </div>
                                                </p>
                                            @endif

                                            <!-- File Tiga -->
                                            @if ($arsip->file_tiga)
                                                <p>
                                                <div class="col-sm-12 mb-3">
                                                    <label class="form-label"><strong>File
                                                            Tiga&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong></label>
                                                    <a href="{{ asset('storage/' . $arsip->file_tiga) }}" target="_blank"
                                                        class="btn btn-success btn-sm">Unduh</a>
                                                </div>
                                                </p>
                                            @endif

                                            <!-- File Empat -->
                                            @if ($arsip->file_empat)
                                                <p>
                                                <div class="col-sm-12 mb-3">
                                                    <label class="form-label"><strong>File
                                                            Empat&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong></label>
                                                    <a href="{{ asset('storage/' . $arsip->file_empat) }}" target="_blank"
                                                        class="btn btn-success btn-sm">Unduh</a>
                                                </div>
                                                </p>
                                            @endif

                                            <!-- File Lima -->
                                            @if ($arsip->file_lima)
                                                <p>
                                                <div class="col-sm-12 mb-3">
                                                    <label class="form-label"><strong>File
                                                            Lima&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong></label>
                                                    <a href="{{ asset('storage/' . $arsip->file_lima) }}" target="_blank"
                                                        class="btn btn-success btn-sm">Unduh</a>
                                                </div>
                                                </p>
                                            @endif

                                            <!-- Jika tidak ada file sama sekali -->
                                            @if (!$arsip->file_satu && !$arsip->file_dua && !$arsip->file_tiga && !$arsip->file_empat && !$arsip->file_lima)
                                                <p>
                                                <div class="col-sm-12">
                                                    <p>Tidak ada dokumen yang diunggah</p>
                                                </div>
                                                </p>
                                            @endif
                                        </div>
                                        <hr>

                                        <div class="form-group mb-3">
                                            <!-- Tombol Kembali -->


                                            @if (Auth::user()->role_as == '2')
                                                <a href="{{ route('arsip_pembelajaran.index') }}"
                                                    class="btn btn-secondary">Kembali</a>
                                            @else
                                                <a href="{{ route('user.dashboard') }}"
                                                    class="btn btn-secondary">Kembali</a>
                                            @endif
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
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
