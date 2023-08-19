<nav>
    <div class="nav-link">
        <div class="header">
            <a href="{{ url('/') }}"><i class='bx bx-home'></i></a>
            <h1 class="head-title"></h1>
        </div>
        <div class="mode">
            <i class='light bx bxs-sun' style="color: #363636;"></i>
            <i class='dark bx bxs-moon' style='color:#363636'></i>
        </div>
        <div class="username">
            <span>Hey, <strong>{{ auth()->user()->name }}</strong></span>
            @if (auth()->user()->level == 1)
                <span>Admin</span>
            @endif
            @if (auth()->user()->level == 2)
                <span>Creator</span>
            @endif
        </div>
        <div class="userProfile">
            @if (auth()->user()->img == 'user.png')
                <img src="{{ url('img/' . auth()->user()->img) }}" alt="image">
            @else
                <img src="{{ url(asset('storage/' . auth()->user()->img)) }}" alt="image">
            @endif
        </div>
    </div>
</nav>
