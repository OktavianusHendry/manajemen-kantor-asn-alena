@extends('layoutss.template')
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
                                    Anda telah menjadi, <span class="fw-bold">Crew</span>
                                    <br>sekarang anda memiliki izin
                                    <br>untuk mengatur semua konten
                                    <br>dalam website
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

            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="card"
                    style="background: url('assets/img/illustrations/content1.jpg') center/cover no-repeat;">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../assets/img/icons/unicons/chart-success2.png" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <?php
                        $inputs = \App\Models\Kategori::all()->count();
                        ?>
                        <span>Jumlah</span>
                        <br><span><b>Kategori</b></span>
                        <br>&nbsp;
                        <h3 class="card-title text-nowrap mb-1">{{ $kategoris }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card"
                    style="background: url('assets/img/illustrations/content1.jpg') center/cover no-repeat;">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../assets/img/icons/unicons/chart-success1.png" alt="chart success"
                                    class="rounded" />
                            </div>
                        </div>
                        <?php
                        $inputs = \App\Models\Sub_Kategori::all()->count();
                        ?>
                        <span>Jumlah</span>
                        <br><span><b>Sub Kategori</b></span>
                        <br>&nbsp;
                        <h3 class="card-title text-nowrap mb-1">{{ $sub_kategoris }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card"
                    style="background: url('assets/img/illustrations/content1.jpg') center/cover no-repeat;">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../assets/img/icons/unicons/chart-success1.png" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <?php
                        $numberOfUsers = \App\Models\Surat_Masuk::count();
                        ?>
                        <span>Jumlah</span>
                        <br><span><b>Surat Masuk</b></span>
                        <br>&nbsp;
                        <h3 class="card-title text-nowrap mb-1">{{ $suratmasuks }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card"
                    style="background: url('assets/img/illustrations/content1.jpg') center/cover no-repeat;">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../assets/img/icons/unicons/chart-success1.png" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <?php
                        $numberOfUsers = \App\Models\Surat_Keluar::count();
                        ?>
                        <span>Jumlah</span>
                        <br><span><b>Surat Keluar</b></span>
                        <br>&nbsp;
                        <h3 class="card-title text-nowrap mb-1">{{ $suratkeluars }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
