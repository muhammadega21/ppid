@extends('layouts.main')

@section('container')
    <div class="content-wrapper">
        <div class="content">
            <div class="new-content">
                <div class="top-content">
                    <h1>{{ $subTitle }}</h1>
                    <div class="line"></div>
                </div>
                <div class="new-wrapper">
                    @foreach ($posts as $post)
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
                <div class="pagination">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
        <div class="sidebar" style="margin-top: 20px">
            @include('home.sidebar')
        </div>
    </div>
@endsection
