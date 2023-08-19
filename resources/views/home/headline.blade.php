<div class="headline">
    <div class="slide-wrapper">
        <div class="slide">
            <div class="img-content">
                <img src="{{ url(asset('storage/' . $post[0]->image)) }}" alt="image">
                <div class="overlay"></div>
            </div>
            <div class="body-content">
                <div class="category-content">
                    <h4><a
                            href="{{ url('/indeks?category=' . $post[0]->category->slug) }}">{{ $post[0]->category->name }}</a>
                    </h4>
                </div>
                <div class="title">
                    <p><a href="{{ url('/read/' . $post[0]->slug) }}">{{ $post[0]->title }}</a></p>
                </div>
                <div class="time">
                    <p>{{ $post[0]->formatted_posts }} WIB</p>
                </div>
            </div>
        </div>
    </div>
</div>
