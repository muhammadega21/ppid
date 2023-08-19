<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ url('css/dashboard/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/auth/register.css') }}">
    <link rel="stylesheet" href="{{ url('css/auth/main.css') }}">
    <link rel="stylesheet" href="{{ url('boxicons/css/boxicons.min.css') }}">
</head>

<body>

    {{-- Alert --}}
    @if ($errors->all())
        <div id="flash-message" class="alert alert-fail">
            <div class="alert-content">
                <i class='bx bx-x icon'></i>
                <div class="alert-message">
                    <span class="text text-1">Error</span>
                    @foreach ($errors->all() as $message)
                        <span class="text text-2">{{ $message }}</span>
                    @endforeach
                </div>
            </div>
            <i class='bx bx-x alert-close'></i>

            <div class="alert-progress"></div>
        </div>
    @endif
    {{-- Alert --}}

    {{-- Register --}}
    <div class="container">
        <main>
            <div class="left">
                <div class="header">
                    <h1>Portal<span>Berita</span></h1>
                    <h4>Indonesia</h4>
                </div>
                <div class="form-input">
                    <form action="{{ url('/register') }}" method="POST">
                        @csrf
                        <div class="input-box @error('name') is-invalid @enderror">
                            <input type="text" name="name" id="name" oninput="nameInput()" placeholder="Nama"
                                value="{{ old('name') }}" required>
                            <i class='bx bx-user'></i>
                        </div>
                        <input type="hidden" name="username" id="slug">
                        <div class="input-box @error('email') is-invalid @enderror">
                            <input type="email" name="email" id="email" oninput="emailInput()"
                                placeholder="Email" value="{{ old('email') }}" required>
                            <i class='bx bx-envelope'></i>
                        </div>
                        <div class="input-box @error('password') is-invalid @enderror">
                            <i id="showPassword" onclick="showPass()" class='bx bxs-hide'></i>
                            <input type="password" name="password" id="password" oninput="passInput()"
                                placeholder="Password" required>
                            <i class='bx bxs-lock-alt'></i>
                        </div>
                        <button>Register</button>
                    </form>
                </div>
                <div class="action">
                    <p>Already have an account? <a class="login" href="{{ url('/login') }}">Login</a></p>

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
    {{-- Register --}}




    <script src="{{ url('js/script.js') }}"></script>
    <script src="{{ url('js/auth.js') }}"></script>
</body>

</html>
