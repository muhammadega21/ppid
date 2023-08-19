@extends('layouts.main')

@section('container')
    <div class="read-wrapper">
        <div class="read">
            <div class="top-content">
                <div class="category-content">
                    <a href="{{ url('/indeks?category=' . $post->category->slug) }}">{{ $post->category->name }}</a>
                </div>
                <div class="title">
                    <h1>{{ $post->title }}</h1>
                </div>
                <div class="content-writer">
                    <a href="{{ url('/indeks?user=' . $post->user->username) }}">{{ $post->user->name }}</a>
                    <p>- Kamis,20 Juli 2023 | 18:30 WIB </p>
                </div>

                <div class="action">
                    @auth
                        <form action="{{ url('/posts/action/' . $post->id) }}">
                            <button class="{{ @$action->like ? 'active' : '' }}" type="submit" name="like"
                                value="{{ $post->id }}"><i class='bx bx-like'></i></button>
                            <button class="{{ @$action->dislike ? 'active' : '' }}" type="submit" name="dislike"
                                value="{{ $post->id }}"><i class='bx bx-dislike'></i></button>
                        </form>
                        <form style="margin-left: 2px" action="{{ url('/posts/bookmark/' . $post->id) }}">
                            <button class="{{ @$action->bookmark ? 'active' : '' }}" type="submit" name="bookmark"
                                value="{{ $post->id }}"><i class='bx bx-bookmark'></i></button>
                        </form>
                    @endauth
                    @guest
                        <form action="{{ url('/login') }}">
                            <button type="submit" name="like"><i class='bx bx-like'></i></button>
                            <button type="submit" name="dislike"><i class='bx bx-dislike'></i></button>
                        </form>
                        <form style="margin-left: 2px" action="{{ url('/posts/bookmark/' . $post->id) }}">
                            <button type="submit" name="bookmark"><i class='bx bx-bookmark'></i></button>
                        </form>
                    @endguest
                </div>
            </div>
            <div class="body-content">
                <div class="image-content">
                    <img src="{{ url(asset('storage/' . $post->image)) }}" alt="image">
                </div>
                <div class="img-sc">
                    <p>(pixiv/&#64;user67846920)</p>
                </div>
                <div class="article">
                    {!! $post->content !!}
                </div>
            </div>
            <div class="bottom-content">
                <div class="action">
                    @auth
                        <form action="{{ url('/posts/action/' . $post->id) }}">
                            <button class="{{ @$action->like ? 'active' : '' }}" type="submit" name="like"
                                value="{{ $post->id }}"><i class='bx bx-like'></i></button>
                            <button class="{{ @$action->dislike ? 'active' : '' }}" type="submit" name="dislike"
                                value="{{ $post->id }}"><i class='bx bx-dislike'></i></button>
                        </form>
                        <form style="margin-left: 2px" action="{{ url('/posts/bookmark/' . $post->id) }}">
                            <button class="{{ @$action->bookmark ? 'active' : '' }}" type="submit" name="bookmark"
                                value="{{ $post->id }}"><i class='bx bx-bookmark'></i></button>
                        </form>
                    @endauth
                    @guest
                        <form action="{{ url('/login') }}">
                            <button type="submit" name="like"><i class='bx bx-like'></i></button>
                            <button type="submit" name="dislike"><i class='bx bx-dislike'></i></button>
                        </form>
                        <form style="margin-left: 2px" action="{{ url('/posts/bookmark/' . $post->id) }}">
                            <button type="submit" name="bookmark"><i class='bx bx-bookmark'></i></button>
                        </form>
                    @endguest
                </div>
                <div class="tag-wrapper">
                    <h3>Tag</h3>
                    <div class="list-tag">
                        @foreach ($tag as $tag)
                            <a href="{{ url('/indeks?tag=' . $tag) }}">{{ $tag }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div id="disqus_thread" class="comment"></div>
            <script>
                (function() { // DON'T EDIT BELOW THIS LINE
                    var d = document,
                        s = d.createElement('script');
                    s.src = 'https://portal-berita-id.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
                    Disqus.</a></noscript>
        </div>
        <div class="sidebar">
            @include('home.sidebar')
        </div>
    </div>
@endsection
