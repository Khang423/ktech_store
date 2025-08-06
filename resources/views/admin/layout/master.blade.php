<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>
        Dashboard | K-Tech
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <link rel="shortcut icon" href="{{ asset('asset/admin/systemImage/short_icon_ktech.svg') }}">
    @include('admin.layout.import-css')
    @stack('css')
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
    <div class="wrapper">
        @include('admin.layout.header')
        @include('admin.layout.sidebar')
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <b class="page-title">
                                    @yield('title')
                                </b>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.layout.footer')
        </div>
    </div>
    @include('admin.layout.rightbar')
    @include('admin.layout.import-js')
    @stack('js')
</body>

</html>
