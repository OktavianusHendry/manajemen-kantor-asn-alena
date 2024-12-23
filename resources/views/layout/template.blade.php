<!DOCTYPE html>
<html lang="en-US" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- ===============================================-->
        <!--    Document Title-->
        <!-- ===============================================-->
        <title>Anagata Sisedu Nusantara | Internal Documenter Needs </title>


        <!-- ===============================================-->
        <!--    Favicons-->
        <!-- ===============================================-->
        <link rel="apple-touch-icon" sizes="180x180" href="asset/img/favicons/favicon.ico">
        <link rel="icon" type="image/x-icon" sizes="32x32" href="asset/img/favicons/favicon.ico">
        <link rel="icon" type="image/x-icon" sizes="16x16" href="asset/img/favicons/favicon.ico">
        <link rel="shortcut icon" type="image/x-icon" href="asset/img/favicons/favicon.ico">
        <link rel="manifest" href="asset/img/favicons/manifest.json">
        <meta name="msapplication-TileImage" content="asset/img/favicons/favicon.ico">
        <meta name="theme-color" content="#ffffff">


        <!-- ===============================================-->
        <!--    Stylesheets-->
        <!-- ===============================================-->
        <link href="asset/css/theme.css" rel="stylesheet" />

    </head>



    <body>

        <!-- Navbar -->
        @include('layout.navbar')
        <!-- / Navbar -->



        <!-- ===============================================-->
        <!--    Main Content-->
        <!-- ===============================================-->
        @yield('content')
        <!-- ===============================================-->
        <!--    End of Main Content-->
        <!-- ===============================================-->




        <!-- ===============================================-->
        <!--    JavaScripts-->
        <!-- ===============================================-->
        <script src="vendors/@popperjs/popper.min.js"></script>
        <script src="vendors/bootstrap/bootstrap.min.js"></script>
        <script src="vendors/is/is.min.js"></script>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
        <script src="vendors/fontawesome/all.min.js"></script>
        <script src="asset/js/theme.js"></script>

        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap"
            rel="stylesheet">
    </body>

</html>
