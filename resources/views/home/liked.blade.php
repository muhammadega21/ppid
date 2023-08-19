@extends('layouts.main')

@section('container')
    <div class="content-wrapper">
        <div class="content">
            <div class="new-content">
                <div class="top-content">
                    <h1>Berita Yang Disimpan</h1>
                    <div class="line"></div>
                </div>
                <div class="new-wrapper">
                    @foreach ($data as $post)
                        <div class="new">
                            <div class="img-content">
                                <a href="{{ url('/read/' . $post->like) }}">
                                    <img src="{{ url(asset('storage/' . $post->post->image)) }}" alt="image">
                                </a>
                            </div>
                            <div class="body-content">
                                <div class="category-content">
                                    <h4><a
                                            href="{{ url('/indeks?category=' . $post->post->category->slug) }}">{{ $post->post->category->name }}</a>
                                    </h4>
                                </div>
                                <div class="title">
                                    <p><a href="{{ url('/read/' . $post->like) }}">{{ $post->post->title }}</a></p>
                                </div>
                                <div class="time">
                                    <p>Disukai {{ $post->formatted_posts }} WIB</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
        <div class="sidebar" style="margin-top: 20px">
            @include('home.sidebar')
        </div>
    </div>
@endsection
