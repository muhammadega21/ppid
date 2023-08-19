@extends('dashboard.layouts.main')
@section('container')
    <div class="post-wrapper">
        <div class="post">
            <div class="top">
                <div class="action">
                    <a id="blue" href="{{ url('dashboard/posts/create') }}"><i class="bx bx-plus"></i> Post Baru</a>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <td>Judul</td>
                        <td>View</td>
                        <td>Like</td>
                        <td>Dislike</td>
                        <td>Bookmark</td>
                        <td>Tanggal Terbit</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td style="max-width: 400px">{{ $post->title }}</td>
                            <td> - </td>
                            <td> {{ $post->action->whereNotNull('like')->count() }} </td>
                            <td> {{ $post->action->whereNotNull('dislike')->count() }} </td>
                            <td> {{ $post->action->whereNotNull('bookmark')->count() }} </td>
                            <td>{{ $post->formatted_post }}</td>
                            <td>
                                <form action="{{ url('/read/' . $post->slug) }}">
                                    @csrf
                                    <button><i id="show" class='bx bxs-show'></i></button>
                                </form>
                                <form action="{{ url('dashboard/posts/' . $post->id . '/edit') }}">
                                    @csrf
                                    <button><i id="edit" class='bx bxs-edit-alt'></i></button>
                                </form>
                                <form action="{{ url('dashboard/posts/' . $post->id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button onclick="return confirm('Apakah Anda Yakin?')"><i id="delete"
                                            class='bx bxs-trash-alt'></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
