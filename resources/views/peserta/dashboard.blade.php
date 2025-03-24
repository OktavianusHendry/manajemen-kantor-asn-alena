@extends('layoutss.template')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-13 mb-4">
                <div class="card" style="background: url('public/assets/img/illustrations/Header.png') center/cover no-repeat;">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h3 class="card-title text-primary"><b>Halo, Selamat Datang! &#128516; &#10024;</b></h3>
                                <p class="mb-4">
                                    Anda telah menjadi, <span class="fw-bold">Peserta</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="../public/assets/img/illustrations/man-with-laptop-light.png" height="140"
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
    </div>
@endsection
