<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title class="title">Portal Berita | {{ $title }}</title>
    <link rel="stylesheet" href="{{ url('css/dashboard/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/dashboard/layouts/main.css') }}">
    <link rel="stylesheet" href="{{ url('css/dashboard/layouts/sidebar.css') }}">
    <link rel="stylesheet" href="{{ url('css/dashboard/layouts/navbar.css') }}">
    <link rel="stylesheet" href="{{ url('css/dashboard/posts/post.css') }}">
    <link rel="stylesheet" href="{{ url('css/dashboard/posts/profile.css') }}">
    <link rel="stylesheet" href="{{ url('boxicons/css/boxicons.min.css') }}">

    {{-- select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- Trix Editor --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

</head>

<body>

    <div class="container">
        @include('dashboard.layouts.sidebar')
        @include('dashboard.layouts.navbar')
        <div class="content">
            @if (session('success'))
                <div id="flash-message" class="alert alert-success">
                    <div class="alert-content">
                        <i class='bx bx-check icon'></i>
                        <div class="alert-message">
                            <span class="text text-1">success</span>
                            <span class="text text-2">{{ session('success') }}</span>
                        </div>
                    </div>
                    <i class='bx bx-x alert-close'></i>

                    <div class="alert-progress"></div>
                </div>
            @endif

            @if (session('Error'))
                <div id="flash-message" class="alert alert-fail">
                    <div class="alert-content">
                        <i class='bx bx-x icon'></i>
                        <div class="alert-message">
                            <span class="text text-1">Error</span>
                            <span class="text text-2">{{ session('Error') }}</span>
                        </div>
                    </div>
                    <i class='bx bx-x alert-close'></i>

                    <div class="alert-progress"></div>
                </div>
            @endif
            @yield('container')
        </div>
    </div>

    <script src="{{ url('js/script.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- select2 --}}
    <script>
        $(document).ready(function() {
            $('#category').select2();
        });
    </script>
    {{-- select2 --}}

</body>

</html>
