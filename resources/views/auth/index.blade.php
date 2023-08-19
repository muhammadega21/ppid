<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ url('css/dashboard/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/auth/login.css') }}">
    <link rel="stylesheet" href="{{ url('css/auth/main.css') }}">
    <link rel="stylesheet" href="{{ url('boxicons/css/boxicons.min.css') }}">
    {{-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> --}}
</head>

<body>

    {{-- alert --}}
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

    @if (session('loginError'))
        <div id="flash-message" class="alert alert-fail">
            <div class="alert-content">
                <i class='bx bx-x icon'></i>
                <div class="alert-message">
                    <span class="text text-1">Error</span>
                    <span class="text text-2">{{ session('loginError') }}</span>
                </div>
            </div>
            <i class='bx bx-x alert-close'></i>

            <div class="alert-progress"></div>
        </div>
    @endif
    {{-- alert --}}

    {{-- Form Login --}}
    <div class="container">
        <main>
            <div class="left">
                <div class="header">
                    <h1>Portal<span>Berita</span></h1>
                    <h4>Indonesia</h4>
                </div>
                <div class="form-input">
                    <form action="{{ url('/login') }}" method="POST">
                        @csrf
                        <div class="input-box">
                            <input type="email" name="email" id="email" oninput="emailInput()"
                                placeholder="Email" required>
                            <i class='bx bx-envelope'></i>
                        </div>
                        <div class="input-box">
                            <i id="showPassword" onclick="showPass()" class='bx bxs-hide'></i>
                            <input type="password" name="password" id="password" oninput="passInput()"
                                placeholder="Password" required>
                            <i class='bx bxs-lock-alt'></i>
                        </div>
                        <button>Login</button>
                        <div class="action">
                            <a class="forgot" href="">Forgot Password?</a>
                            <a class="register" href="{{ url('/register') }}">Register</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="waves">
                <img src="img/waves.png" alt="">
            </div>
            <div class="waves2">
                <img src="img/waves.png" alt="">
            </div>
            <div class="background"></div>
            <div class="right">
                <img src="img/bg.png" alt="">
            </div>
        </main>
    </div>
    {{-- Form Login --}}





    <script src="{{ url('js/script.js') }}"></script>
    <script src="{{ url('js/auth.js') }}"></script>
</body>

</html>
