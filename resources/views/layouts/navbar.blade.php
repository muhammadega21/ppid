<nav>
    <div class="navbar">
        <ul>
            <li class="{{ Request::is('/','indeks', 'read*', 'saved*', 'liked*')&& empty(request()->query()) . Request::query('user') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
            @foreach ($categories as $category)
                <li class="{{ Request::query('category') === $category->slug ? 'active' : '' }}"><a href="{{ url('/indeks?category=' . $category->slug) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>
</nav>
