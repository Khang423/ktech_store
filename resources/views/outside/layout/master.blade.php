
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
</head>

<body>

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
