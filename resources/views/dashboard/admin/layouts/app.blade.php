<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ponpes Kanak-Kanak Darussalam</title>
    <link href="{{ asset('dist/css/lineicons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/datatable/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/loader.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/main.css') }}">

    @laravelPWA


</head>
<style>
.btn {
    font-weight: bold;
    border-radius: 20px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    transition: background-color 0.3s;
}
</style>
<body>
    <div class="wrapper">
        <div class="loader-container" id="loader-container" style="display: none"></div>
        @include('dashboard.admin.layouts.sidebar')
        <div class="main">
            @include('dashboard.admin.layouts.navbar')
            <main class="content py-4">
                <div id="loader" class="loader"></div>
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
            {{--  @include('dashboard.admin.layouts.footer')  --}}
        </div>
    </div>

{{--  jquery 3.7  --}}
<script src="{{ asset('dist/js/jquery.min.js') }}"></script>
{{--  bootstrap 5.3  --}}
<script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
{{--  dataTable export  --}}
<script src="{{ asset('dist/js/datatable/dataTables.js') }}"></script>
<script src="{{ asset('dist/js/datatable/dataTables.bootstrap5.js') }}"></script>
{{--  sweet  --}}
<script src="{{ asset('dist/js/sweetalert2.all.min.js') }}"></script>
{{--  toast  --}}
<script src="{{ asset('dist/js/toastr.min.js') }}"></script>
{{--  main js  --}}
<script src="{{ asset('dist/js/main.js') }}"></script>
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
            document.getElementById('loader').style.display = 'none';
            document.getElementById('loader-container').style.display = 'none';
        }
    });
</script>
@stack('script')
</body>
</html>
