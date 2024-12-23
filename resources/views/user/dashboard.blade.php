@extends('layoutsss.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-13 mb-4">
                <div class="card" style="background: url('assets/img/illustrations/Header.png') center/cover no-repeat;">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h3 class="card-title text-primary"><b>Halo, Selamat Datang! &#128516; &#10024;</b></h3>
                                <p class="mb-4">
                                    Anda telah menjadi, <span class="fw-bold">Mentor</span>
                                    <br>sekarang anda memiliki izin
                                    <br>untuk mengakses module pembelajaran
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>

                @if (session('notification'))
                    <div class="alert alert-info">
                        {{ session('notification') }}
                    </div>
                @endif

                <pre></pre>
                <pre></pre>

                <!-- Form untuk pencarian dan filter -->
                <form method="GET" action="{{ route('user.dashboard') }}" class="mb-4">
                    <div class="row">
                        <!-- Dropdown filter berdasarkan id_jenjang -->
                        <div class="col-md-2 mb-3 mr-1">
                            <select name="id_jenjang" class="form-select" onchange="this.form.submit()">
                                <option value="">-- Pilih Jenjang --</option>
                                @foreach ($jenjangs as $jenjang)
                                    <option value="{{ $jenjang->id_jenjang }}"
                                        {{ request('id_jenjang') == $jenjang->id_jenjang ? 'selected' : '' }}>
                                        {{ $jenjang->nama_jenjang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 mb-3 mr-1">
                            <select name="id_kategori" class="form-select" onchange="this.form.submit()">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}"
                                        {{ request('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 mb-3 mr-1">
                            <select name="id_sub_kategori" class="form-select" onchange="this.form.submit()">
                                <option value="">-- Pilih Sub Kategori --</option>
                                @foreach ($sub_kategoris as $sub_kategori)
                                    <option value="{{ $sub_kategori->id_sub_kategori }}"
                                        {{ request('id_sub_kategori') == $sub_kategori->id_sub_kategori ? 'selected' : '' }}>
                                        {{ $sub_kategori->nama_sub_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Kolom pencarian -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group d-flex">
                                <input type="text" name="search" value="{{ request()->input('search') }}"
                                    class="form-control" placeholder="Cari berdasarkan judul dan pertemuan ke berapa ...">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>

                    </div>
                </form>

                <!-- Tampilkan arsip pembelajaran dalam card -->
                <div class="row mb-5">
                    @foreach ($arsips as $arsip)
                        <div class="col-md-5 col-lg-3 mb-4 ms-0">
                            <div class="card h-100 arsip_pembelajaran-card"
                                data-arsip_pembelajaran-id="{{ $arsip->id_arsip_pembelajaran }}">
                                <!-- Canvas untuk menampilkan cover PDF -->
                                <canvas id="pdf-canvas-{{ $arsip->id_arsip_pembelajaran }}" class="mb-3" width="300"
                                    height="200"></canvas>

                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title text-primary">{{ $arsip->judul_pembelajaran }}</h5>
                                    <p class="card-text">{{ $arsip->catatan }}</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('arsip_pembelajaran.show', $arsip->id_arsip_pembelajaran) }}"
                                            class="btn rounded-pill btn-primary mb-2 col-12">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- JavaScript untuk merender cover PDF -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const pdfUrl = "{{ asset('storage/' . $arsip->file_satu) }}"; // Pastikan path PDF sudah benar
                                const canvasId = "pdf-canvas-{{ $arsip->id_arsip_pembelajaran }}";
                                const canvas = document.getElementById(canvasId);
                                const ctx = canvas.getContext('2d');

                                // Memuat file PDF
                                pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
                                    // Mengambil halaman pertama
                                    pdf.getPage(1).then(function(page) {
                                        const viewport = page.getViewport({
                                            scale: 1.0
                                        });
                                        canvas.height = viewport.height;
                                        canvas.width = viewport.width;

                                        const renderContext = {
                                            canvasContext: ctx,
                                            viewport: viewport
                                        };

                                        // Render halaman pertama PDF ke canvas
                                        page.render(renderContext);
                                    });
                                });
                            });
                        </script>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $arsips->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
