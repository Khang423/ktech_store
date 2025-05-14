<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>
        Dashboard | K-Tech
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <link rel="shortcut icon" href="{{ asset('asset/admin/systemImage/short_icon_ktech.svg') }}">

    <link href="{{ asset('css/libraries/datatable/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('css/libraries/datatable/responsive.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('css/admin/hyper/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('css/admin/hyper/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    @stack('css')
</head>

<body>
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
    <script src="{{ asset('js/libraries/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('js/admin/hyper/hyper-config.js') }}"></script>
    <script src="{{ asset('js/admin/hyper/vendor.min.js') }}"></script>
    <script src="{{ asset('js/admin/hyper/app.min.js') }}"></script>
    <script src="{{ asset('js/admin/main.js') }}"></script>

    <script src="{{ asset('js/libraries/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/libraries/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/libraries/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/libraries/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/libraries/datatable/dataTables.checkboxes.min.js') }}"></script>

    <script src="{{ asset('js/libraries/sweetalert/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/libraries/sweetalert/confirm_toast.js') }}"></script>
    <script src="{{ asset('js/libraries/sweetalert/confirm_alert.js') }}"></script>

    {{-- tinymce js --}}
    <script src="{{ asset('vendor/tinymce/tinymce.js') }}"></script>
    <script src="{{ asset('vendor/tinymce/config.js') }}"></script>

    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    @stack('js')
</body>

</html>
