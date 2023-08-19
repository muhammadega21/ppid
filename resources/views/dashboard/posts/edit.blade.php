@extends('dashboard.layouts.main')
@section('container')
    @if ($errors->all())
        <div id="flash-message" class="alert alert-fail">
            <div class="alert-content">
                <i class='bx bx-x icon'></i>
                <div class="alert-message">
                    <span class="text text-1">Error</span>
                    @foreach ($errors->all() as $message)
                        <span class="text text-2">{{ $message }}</span>
                    @endforeach
                </div>
            </div>
            <i class='bx bx-x alert-close'></i>

            <div class="alert-progress"></div>
        </div>
    @endif
    <div class="post-wrapper">
        <div class="post">
            <div class="form-input">
                <form action="{{ url('dashboard/posts/' . $post->id) }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="slug" id="slug" value="{{ old('slug', $post->slug) }}">
                    <div class="input-group">
                        <div class="input">
                            <label for="title">Judul</label>
                            <input type="text" name="title" id="name" value="{{ old('title', $post->title) }}">
                        </div>
                        <div class="input">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category">
                                @foreach ($category as $category)
                                    @if (old('category_id', $post->category_id) == $category->id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="input">
                        <label>Tag</label>
                        <input type="hidden" name="post_tag" id="post_tag" value="{{ old('post_tag', $post->post_tag) }}">
                        <div class="tag-wrapper">
                            <p>Tambah koma(",") setelah menulis sebuah tag</p>
                            <div class="tag-box">
                                <ul>
                                    @foreach ($tag as $tag)
                                        <li>{{ old('post_tag', $tag) }} <i class='bx bx-x'
                                                onclick="removeTag(this, '{{ old('post_tag', $tag) }}')"></i></li>
                                    @endforeach
                                    <input type="text" id="tag">
                                </ul>
                            </div>
                            <div class="details">
                                <p>Max 10 Tag (<span>-</span> tag lagi)</p>
                                <div class="action">
                                    <button type="button" id="red">Remove All</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input">
                        <label for="image" class="form-label">Foto Profile</label>
                        <div class="upload-file">
                            <input type="file" id="image" name="image" onchange="previewImage()">
                            <label for="image"><i class='bx bxs-cloud-upload'></i>Upload File</label>
                        </div>
                        <input type="hidden" name="oldImage" value="{{ $post->image }}">
                        <div class="imgPreview">
                            @if ($post->image)
                                <img src="{{ url(asset('storage/' . $post->image)) }}" class="img-preview" width="100">
                            @else
                                <img class="img-preview" width="100">
                            @endif
                        </div>
                    </div>
                    <div class="input">
                        <input id="content" type="hidden" value="{{ old('content', $post->content) }}" name="content">
                        <div class="content-wrapper">
                            <trix-editor input="content"></trix-editor>
                        </div>
                    </div>
                    <div class="action">
                        <button id="blue">Update</button>
                        <a id="red" href="{{ url('dashboard/posts') }}">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    @endsection
