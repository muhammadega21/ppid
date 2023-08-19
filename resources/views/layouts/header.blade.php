<div class="header">
    <main>
        <div class="web-title">
            <a style="color: var(--black)" href="{{ url('/') }}">
                <h1>Portal<span>Berita</span></h1>
                <h4>Indonesia</h4>
            </a>
        </div>
        <div class="head-side">
            <div class="form-input">
                <form action="{{ url('/indeks') }}">
                    @if (request('tag'))
                        <input type="hidden" name="tag" value="{{ request('tag') }}">
                    @endif
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if (request('user'))
                        <input type="hidden" name="user" value="{{ request('user') }}">
                    @endif
                    <input type="text" name="search" placeholder="Search" value="{{ request('search') }}">
                    <button type="submit"><i class='bx bx-search-alt'></i></button>
                </form>
            </div>
            @auth
                <div class="option">
                    <div class="user-profile">
                        @if (auth()->user()->img == 'user.png')
                            <img src="{{ url('img/' . auth()->user()->img) }}" alt="image">
                        @else
                            <img src="{{ url(asset('storage/' . auth()->user()->img)) }}" alt="image">
                        @endif
                    </div>
                    <div class="user-info">
                        <a href="">
                            <div class="user-name">
                                <div class="profile">
                                    @if (auth()->user()->img == 'user.png')
                                        <img src="{{ url('img/' . auth()->user()->img) }}" alt="image">
                                    @else
                                        <img src="{{ url(asset('storage/' . auth()->user()->img)) }}" alt="image">
                                    @endif
                                </div>
                                <div class="name">
                                    <h4>{{ auth()->user()->name }}</h4>
                                    <p>{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </a>
                        @can('creator')
                            <a href="{{ url('/dashboard') }}">
                                <i class='bx bxs-dashboard'></i>
                                <p>Dashboard</p>
                            </a>
                        @endcan
                        <a href="{{ url('/saved/' . auth()->user()->username) }}">
                            <i class='bx bx-bookmark'></i>
                            <p>Konten yang disimpan</p>
                        </a>
                        <a href="{{ url('/liked/' . auth()->user()->username) }}">
                            <i class='bx bx-like'></i>
                            <p>Konten yang disukai</p>
                        </a>
                        <a href="{{ url('/logout') }}">
                            <i class='bx bx-log-out'></i>
                            <p>Logout</p>
                        </a>
                    </div>
                </div>
            @else
                <div class="option">
                    <div class="user-profile">
                        <img src="{{ url('img/user.png') }}" alt="">
                    </div>
                    <div class="user-info">
                        <a href="">
                            <div class="user-name">
                                <div class="profile">
                                    <img src="{{ url('img/user.png') }}" alt="">
                                </div>
                                <div class="name">
                                    <h4>Guest User</h4>
                                    <p>guestuser@gmail.com</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ url('/login') }}">
                            <i class='bx bx-log-in'></i>
                            <p>Login</p>
                        </a>
                    </div>
                </div>
            @endauth
        </div>
    </main>
</div>
