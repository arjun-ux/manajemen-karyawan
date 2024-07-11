<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-rtJFjbpFdgfe/+4JpujW/4ps5yWn/W9X63jb99uZmaG2JXqGXQ7KU9GM/693XpG” crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/saba.css') }}">
    {{--  select2  --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{--  jquery 3.7  --}}
    <script src="{{ asset('dist/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>
<body>
    @include('dashboard.saba.layouts.nav')
    @yield('content')


    {{--  bootstrap 5.3  --}}
    <script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
    {{--  sweet  --}}
    <script src="{{ asset('dist/js/sweetalert2.all.min.js') }}"></script>
    @stack('script')
</body>
</html>
