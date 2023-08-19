@extends('dashboard.layouts.main')
@section('container')
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
    <div class="post-wrapper">
        <div class="post">
            <div class="profile">
                <form action="{{ url('profile/update/' . $user->id) }}" method="POST" enctype="multipart/form-data">
                    <div class="top">
                        <div class="user-image">
                            <div class="img-wrapper">
                                @if ($user->img)
                                    @if ($user->img == 'user.png')
                                        <img src="{{ url('img/' . $user->img) }}" class="img-preview" alt="image"
                                            width="100">
                                    @else
                                        <img src="{{ url(asset('storage/' . $user->img)) }}" class="img-preview"
                                            alt="image" width="100">
                                    @endif
                                @else
                                    <img class="img-preview" width="100">
                                @endif
                            </div>
                            <div class="side">
                                <div class="img-sett">
                                    <div class="upload-file">
                                        <input class="" type="file" id="image" name="img"
                                            onchange="previewImage()">
                                        <label for="image"><i class='bx bxs-cloud-upload'></i>Change Profile</label>
                                    </div>
                                    <input type="hidden" name="oldImage" value="{{ $user->img }}">
                                </div>
                                <div class="logout">
                                    <div class="action">
                                        <a id="black" onclick="return confirm('Anda Yakin Ingin Logout?')"
                                            href="{{ url('/logout') }}">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="user-profile">
                        @method('put')
                        @csrf
                        <input type="hidden" name="username" id="slug" value="{{ old('name', $user->username) }}">
                        <table>
                            <tr>
                                <td>
                                    <label for="name">Nama</label>
                                </td>
                                <td>
                                    <div class="input">
                                        <input type="text" name="name" id="name"
                                            value="{{ old('name', $user->name) }}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="email">email</label>
                                </td>
                                <td>
                                    <div class="input">
                                        <input type="email" name="email" id="email"
                                            value="{{ old('email', $user->email) }}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="password">password</label>
                                </td>
                                <td>
                                    <div class="input">
                                        <input type="password" name="password" id="password" value="{{ old('password') }}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="alamat">alamat</label>
                                </td>
                                <td>
                                    <div class="input">
                                        <input type="text" name="alamat" id="alamat"
                                            value="{{ old('alamat', $user->alamat) }}">
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div class="action">
                            <button id="blue">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
