<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="public/assets/" data-template="vertical-menu-template-free">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <title>Dashboard Admin| Anagata Internal Documenter</title>
        <meta name="description" content="" />
        <link rel="icon" type="image/x-icon" href="{{ asset('public/assets/img/favicon/favicon.ico') }}" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
            rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('public/assets/vendor/fonts/boxicons.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ asset('public/assets/vendor/css/theme-default.css') }}"
            class="template-customizer-theme-css" />
        <link rel="stylesheet" href="{{ asset('public/assets/css/demo.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
        <script src="{{ asset('public/assets/vendor/js/helpers.js') }}"></script>
        <script src="{{ asset('public/assets/js/config.js') }}"></script>
    </head>

    <body>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                @include('layouts.sidebar')
                <div class="layout-page">
                    @include('layouts.navbar')
                    <div class="content-wrapper">
                        <section>
                            @yield('content')
                            @yield('edit')
                        </section>
                        <footer class="content-footer footer bg-footer-theme">
                            <div
                                class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                                <div class="mb-2 mb-md-0">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    Anagata Sisedu Nusantara
                                </div>
                            </div>
                        </footer>
                        <div class="content-backdrop fade"></div>
                    </div>
                </div>
            </div>
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <script src="{{ asset('public/assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('public/assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('public/assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('public/assets/vendor/js/menu.js') }}"></script>
        <script src="{{ asset('public/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
        <script src="{{ asset('public/assets/js/main.js') }}"></script>
        <script src="{{ asset('public/assets/js/dashboards-analytics.js') }}"></script>
        <script async defer src="https://buttons.github.io/buttons.js"></script>
    </body>

</html>
