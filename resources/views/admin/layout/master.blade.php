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

    @include('admin.layout.import-css')
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
    @include('admin.layout.import-js')
    @stack('js')
</body>

</html>
