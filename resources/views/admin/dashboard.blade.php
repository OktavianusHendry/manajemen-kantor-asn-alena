@extends('layouts.template')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card" style="background: url('public/assets/img/illustrations/Header.png') center/cover no-repeat;">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h3 class="card-title text-primary"><b>Halo, Selamat Datang! &#128516; &#10024;</b></h3>
                                <p class="mb-4">
                                    Anda telah menjadi, <span class="fw-bold">Administrator.</span>
                                    <br>sekarang anda bisa
                                    <br>mengatur semua isi
                                    <br>dalam website
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
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card text-center shadow-lg p-2"
                    style="border-radius: 10px; background: linear-gradient(135deg, #667eea, #24a0e7); color: #ffffff;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #ffffff;">Waktu Saat Ini</h5>
                        <h2 id="clock" class="fw-bold" style="font-size: 48px; letter-spacing: 2px; color: #ffffff;">
                        </h2>
                        <p id="date" style="font-size: 16px; color: #ffffff;"></p>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function updateClock() {
                var now = new Date();
                var hours = now.getHours().toString().padStart(2, '0');
                var minutes = now.getMinutes().toString().padStart(2, '0');
                var seconds = now.getSeconds().toString().padStart(2, '0');
                var timeString = hours + ':' + minutes + ':' + seconds;

                var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
                    'November', 'December'
                ];
                var day = days[now.getDay()];
                var month = months[now.getMonth()];
                var date = now.getDate().toString().padStart(2, '0');
                var fullDate = day + ', ' + date + ' ' + month + ' ' + now.getFullYear();

                document.getElementById('clock').textContent = timeString;
                document.getElementById('date').textContent = fullDate;
            }

            // Update clock every second
            setInterval(updateClock, 1000);
            updateClock(); // Run once immediately to display the time right away
        </script>


        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="card"
                    style="background: url('public/assets/img/illustrations/content1.jpg') center/cover no-repeat;">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../public/assets/img/icons/unicons/chart-success2.png" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <?php
                        $numberOfUsers = \App\Models\User::count();
                        ?>
                        <span>Jumlah</span>
                        <br><span><b>Pengguna</b></span>
                        <br>&nbsp;
                        <h3 class="card-title text-nowrap mb-1">{{ $numberOfUsers }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card"
                    style="background: url('public/assets/img/illustrations/content1.jpg') center/cover no-repeat;">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../public/assets/img/icons/unicons/chart-success1.png" alt="chart success"
                                    class="rounded" />
                            </div>
                        </div>
                        <?php
                        $inputs = \App\Models\Instansi::all()->count();
                        ?>
                        <span>Jumlah</span>
                        <br><span><b>Instansi Kerjasama</b></span>
                        <br>&nbsp;
                        <h3 class="card-title text-nowrap mb-1">{{ $instansis }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card"
                    style="background: url('public/assets/img/illustrations/content1.jpg') center/cover no-repeat;">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../public/assets/img/icons/unicons/chart-success1.png" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <?php
                        $numberOfUsers = \App\Models\Sekolah::count();
                        ?>
                        <span>Jumlah</span>
                        <br><span><b>Sekolah Kerjasama</b></span>
                        <br>&nbsp;
                        <h3 class="card-title text-nowrap mb-1">{{ $sekolahs }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card"
                    style="background: url('public/assets/img/illustrations/content1.jpg') center/cover no-repeat;">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../public/assets/img/icons/unicons/chart-success1.png" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <?php
                        $numberOfUsers = \App\Models\Unit_Penempatan::count(); // Correct casing
                        ?>
                        <span>Jumlah</span>
                        <br><span><b>Mentor</b></span>
                        <br>&nbsp;
                        <h3 class="card-title text-nowrap mb-1">{{ $totalUnitPenempatans }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
