@extends('dashboard.layouts.main')
@section('container')

    {{-- Alert --}}
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
    {{-- Alert --}}

    {{-- Form Create Category --}}
    <div class="post-wrapper">
        <div class="post">
            <div class="form-input">
                <form action="{{ url('dashboard/category') }}" method="POST">
                    @csrf
                    <div class="input">
                        <label for="name">Nama Category</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="input">
                        <label for="slug">Slug Category</label>
                        <input type="text" name="slug" id="slug">
                    </div>
                    <div class="action">
                        <button id="blue">Tambah</button>
                        <a id="red" href="{{ url('dashboard/category') }}">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Form Create Category --}}
@endsection
