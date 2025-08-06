<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>
        {{ $title }}
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('asset/admin/systemImage/short_icon_ktech.svg') }}">

    @include('outside.layout.import-css')
    @stack('css')
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <style>
        .loader {
            width: 48px;
            height: 48px;
            display: inline-block;
            position: relative;
        }

        .loader::after,
        .loader::before {
            content: '';
            width: 48px;
            height: 48px;
            border: 2px solid #000000;
            position: absolute;
            left: 0;
            top: 0;
            box-sizing: border-box;
            animation: rotation 2s ease-in-out infinite;
        }

        .loader::after {
            border-color: #2a52be;
            animation-delay: 1s;
        }

        #loading-spinner {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div id="loading-spinner"
        style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(255,255,255,0.7); z-index:9999; justify-content:center; align-items:center;">
        <div class="loader"></div>
    </div>
    @include('outside.layout.header')
    <div class="container">
        <div class="main-content">
            @yield('content')
        </div>
    </div>
    @include('outside.layout.footer')
    @include('outside.layout.import-js')
    @stack('js')
</body>

</html>
