<div class="sidebar">
    <header>
        <a style="color: var(--black)" href="{{ url('/') }}">
            <h1>Portal<span>Berita</span></h1>
            <h4>Indonesia</h4>
        </a>
    </header>
    <main>
        <div class="side-link">
            <ul>
                <li><span>Home</span></li>
                <li class="{{ Request::is('dashboard', 'home') ? 'active' : '' }}"><a href="{{ url('/dashboard') }}"><i
                            class='bx bxs-dashboard'></i>Dashboard</a></li>
                <li class="{{ Request::is('profile*') ? 'active' : '' }}"><a href="{{ url('/profile') }}"><i
                            class='bx bx-user'></i>Profile</a></li>
                <li><span>Post</span></li>
                <li class="{{ Request::is('dashboard/posts*') ? 'active' : '' }}"><a
                        href="{{ url('dashboard/posts') }}"><i class='bx bx-share-alt'></i>My Post</a></li>
                @can('admin')
                    <li class="{{ Request::is('recPosts*') ? 'active' : '' }}"><a href="{{ url('/recPosts') }}"><i
                                class='bx bx-grid-small' style="scale: 2"></i>All Post</a></li>
                    <li class="{{ Request::is('dashboard/category*') ? 'active' : '' }}"><a
                            href="{{ url('dashboard/category') }}"><i class='bx bx-category'></i>Post Categories</a></li>
                @endcan
                <li><span>Setting</span></li>
                @can('admin')
                    <li class="{{ Request::is('users*') ? 'active' : '' }}"><a href="{{ url('/users') }}"><i
                                class='bx bx-group'></i>Users</a></li>
                @endcan
                <li><a href="{{ url('/logout') }}"><i class='bx bx-log-out'></i>Logout</a></li>
            </ul>
        </div>
    </main>
</div>
