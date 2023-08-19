<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portal Berita | {{ $title }}</title>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/layouts/header.css') }}">
    <link rel="stylesheet" href="{{ url('css/layouts/navbar.css') }}">
    <link rel="stylesheet" href="{{ url('css/layouts/footer.css') }}">
    <link rel="stylesheet" href="{{ url('css/content/home.css') }}">
    <link rel="stylesheet" href="{{ url('css/content/sidebar.css') }}">
    <link rel="stylesheet" href="{{ url('css/content/read.css') }}">

    <link rel="stylesheet" href="{{ url('css/tablet/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/android/style.css') }}">
    <link rel="stylesheet" href="{{ url('boxicons/css/boxicons.min.css') }}">
</head>

<body>
    <div class="container">
        @include('layouts.header')
        @include('layouts.navbar')
        <div class="main-content">
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
            @if (session('error'))
                <div id="flash-message" class="alert alert-fail">
                    <div class="alert-content">
                        <i class='bx bx-x icon'></i>
                        <div class="alert-message">
                            <span class="text text-2">{{ session('error') }}</span>
                        </div>
                    </div>
                    <i class='bx bx-x alert-close'></i>

                    <div class="alert-progress"></div>
                </div>
            @endif
            @yield('container')
        </div>
        @include('layouts.footer')
    </div>

    <script src="{{ url('js/script.js') }}"></script>
</body>

</html>
