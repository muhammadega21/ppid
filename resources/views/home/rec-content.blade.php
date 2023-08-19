<div class="rec-content">
    <div class="top-content">
        <div class="left">
            <h1>Pilihan Editor</h1>
            <div class="line"></div>
        </div>
        <div class="right">
            <div class="slider">
                <div class="slide slider-1 active"></div>
                <div class="slide slider-2"></div>
                <div class="slide slider-3"></div>
            </div>
        </div>
    </div>
    <div class="rec-wrapper">
        @foreach ($recPosts as $post)
            <div class="rec">
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
                        <p>{{ $post->formatted_rec }} WIB</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
