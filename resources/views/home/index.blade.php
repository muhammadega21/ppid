@extends('layouts.main')

@section('container')
    <article>
        <div class="content-wrapper">
            <div class="content">
                @include('home.headline')
                @include('home.rec-content')
                <div class="new-content-wrapper">
                    <div class="new-content">
                        <div class="top-content">
                            <h1>Berita Terkini</h1>
                            <div class="line"></div>
                        </div>
                        <div class="new-wrapper">
                            @foreach ($post->skip(1) as $post)
                                <div class="new">
                                    <div class="img-content">
                                        <a href="{{ url('/read/' . $post->slug) }}">
                                            <img src="{{ url(asset('storage/' . $post->image)) }}" alt="image">
                                        </a>
                                    </div>
                                    <div class="body-content">
                                        <div class="category-content">
                                            <h4><a
                                                    href="{{ url('/indeks?category=' . $post->category->slug) }}">{{ $post->category->name }}</a>
                                            </h4>
                                        </div>
                                        <div class="title">
                                            <p><a href="{{ url('/read/' . $post->slug) }}">{{ $post->title }}</a></p>
                                        </div>
                                        <div class="time">
                                            <p>{{ $post->formatted_posts }} WIB</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="btn-indeks">
                            <a href="{{ url('/indeks') }}">Lihat Semua</a>
                        </div>
                    </div>

                    <div class="sidebar">
                        @include('home.sidebar')
                    </div>
                </div>
            </div>
            <div class="sidebar">
                @include('home.sidebar')
            </div>
        </div>
    </article>
@endsection
