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
                <form action="{{ url('dashboard/posts') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="slug" id="slug" value="{{ old('slug') }}">
                    <div class="input-group">
                        <div class="input">
                            <label>Judul</label>
                            <input type="text" name="title" id="name" value="{{ old('title') }}">
                        </div>
                        <div class="input">
                            <label>Category</label>
                            <select id="category" name="category_id">
                                @foreach ($category as $category)
                                    @if (old('category_id') == $category->id)
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
                        <input type="hidden" name="post_tag" id="post_tag" value="asd">
                        <div class="tag-wrapper">
                            <p>Tambah koma(",") setelah menulis sebuah tag</p>
                            <div class="tag-box">
                                <ul>
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
                        <label class="form-label">Image</label>
                        <div class="upload-file">
                            <input type="file" id="image" name="image" onchange="previewImage()">
                            <label for="image"><i class='bx bxs-cloud-upload'></i>Upload File</label>
                        </div>
                        <input type="hidden" name="oldImage">
                        <div class="imgPreview">
                            <img src="/img/noimage.png" class="img-preview">
                        </div>
                    </div>
                    <div class="input">
                        <input id="content" type="hidden" value="{{ old('content') }}" name="content">
                        <div class="content-wrapper">
                            <trix-editor input="content"></trix-editor>
                        </div>
                    </div>
                    <div class="action">
                        <button id="blue">Tambah</button>
                        <a id="red" href="{{ url('dashboard/posts') }}">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    @endsection
