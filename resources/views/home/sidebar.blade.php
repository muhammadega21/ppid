<div class="sidebar">
    <div class="side-content">
        <div class="top-content">
            <h1>Berita Lainnya</h1>
            <div class="line"></div>
        </div>

        <div class="side-wrapper">
            @foreach ($randomPosts as $post)
                <div class="side">
                    <div class="rank-content">
                        <h1>{{ $loop->iteration }}</h1>
                    </div>
                    <div class="body-content">
                        <h4><a href="{{ url('/read/' . $post->slug) }}">{{ $post->title }}</a></h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="side-content">
        <div class="top-content">
            <h1>{{ $categoryName1 }}</h1>
            <div class="line"></div>
        </div>

        <div class="side-wrapper">
            @foreach ($postbycategory1 as $post)
                <div class="side">
                    <div class="rank-content">
                        <h1>{{ $loop->iteration }}</h1>
                    </div>
                    <div class="body-content">
                        <h4><a href="{{ url('/read/' . $post->slug) }}">{{ $post->title }}</a></h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="side-content">
        <div class="top-content">
            <h1>{{ $categoryName2 }}</h1>
            <div class="line"></div>
        </div>

        <div class="side-wrapper">
            @foreach ($postbycategory2 as $post)
                <div class="side">
                    <div class="rank-content">
                        <h1>{{ $loop->iteration }}</h1>
                    </div>
                    <div class="body-content">
                        <h4><a href="{{ url('/read/' . $post->slug) }}">{{ $post->title }}</a></h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
