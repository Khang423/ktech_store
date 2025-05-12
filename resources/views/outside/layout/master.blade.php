<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>
        K - Tech | Trang chủ
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <link rel="shortcut icon" href="{{ asset('asset/admin/systemImage/short_icon_ktech.svg') }}">

    <link href="{{ asset('css/admin/hyper/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('css/admin/hyper/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/outside/header.css') }}" rel="stylesheet" type="text/css" />
    {{-- swiper css --}}
    <link href="{{ asset('css/libraries/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/outside/header-mobile.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/outside/main.css') }}" rel="stylesheet" type="text/css" />

    @stack('css')
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body>

    @include('outside.layout.header')
    <div class="container">
        <div class="main-content">
            @yield('content')
        </div>
    </div>
    @include('outside.layout.footer')
    <script src="{{ asset('js/libraries/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/admin/hyper/hyper-config.js') }}"></script>
    <script src="{{ asset('js/admin/hyper/vendor.min.js') }}"></script>
    <script src="{{ asset('js/admin/hyper/app.min.js') }}"></script>
    <script src="{{ asset('js/admin/main.js') }}"></script>

    {{-- swiper js  --}}
    <script src="{{ asset('js/libraries/swiper/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('js/libraries/sweetalert/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/libraries/sweetalert/confirm_toast.js') }}"></script>
    <script src="{{ asset('js/libraries/sweetalert/confirm_alert.js') }}"></script>
    {{-- main.js --}}
    <script src="{{ asset('js/outside/main.js') }}"></script>
    <script src="{{ asset('js/outside/animate.js') }}"></script>
    @stack('js')
</body>

</html>
