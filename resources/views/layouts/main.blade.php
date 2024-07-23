<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ponpes Kanak-Kanak Darussalam Blokagung</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/loader.css') }}">
</head>
<style>
    .bg-body{
        background-image: url('img/home.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        width: 100%;
        display: block;
        justify-content: center;
        align-items: center;
    }
</style>
<body>
    <div class="bg-body">
        <div class="loader-container" id="loader-container" style="display: none"></div>
        <div id="loader" class="loader"></div>
        @include('layouts.navbar')
        @yield('content')
        @include('layouts.footer')
        {{--  jquery 3.7  --}}
        <script src="{{ asset('dist/js/jquery.min.js') }}"></script>
        <script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
        {{--  sweet  --}}
        <script src="{{ asset('dist/js/sweetalert2.all.min.js') }}"></script>
        @stack('script')
        @stack('scroll')
        <script>
            // loader when location reload
            window.onbeforeunload = function() {
                isLoading = true;
                document.getElementById('loader').style.display = 'block';
                document.getElementById('loader-container').style.display = 'block';
            };
            // Hide loader when page is loaded
            window.onload = function() {
                document.getElementById('loader').style.display = 'none';
                document.getElementById('loader-container').style.display = 'none';
            };
            // navigation history or back to page before
            window.addEventListener('pageshow', function(event) {
                // Cek apakah event.persisted adalah true, menunjukkan bahwa halaman dimuat kembali dari cache browser
                if (event.persisted) {
                    // Tampilkan loader atau lakukan tindakan lain sesuai kebutuhan Anda
                    console.log('kembali ke halaman sebelum');
                    document.getElementById('loader').style.display = 'none';
                    document.getElementById('loader-container').style.display = 'none';
                }
            });
        </script>

    </div>
</body>
</html>
