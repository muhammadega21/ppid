@extends('dashboard.layouts.main')
@section('container')
    <div class="post-wrapper">
        <div class="post">
            <div class="form-wrapper">
                <div class="form-input">
                    <form action="{{ url('/recPosts') }}">
                        @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        @if (request('user'))
                            <input type="hidden" name="user" value="{{ request('user') }}">
                        @endif
                        <input type="text" name="search" placeholder="Search" value="{{ request('search') }}">
                        <button type="submit"><i class='bx bx-search-alt'></i></button>
                    </form>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <td>Judul</td>
                        <td>Creator</td>
                        <td>Tanggal Terbit</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th>{{ $loop->iteration + ($posts->currentPage() - 1) * $posts->perPage() }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->formatted_posts }}</td>
                            <td id="action">
                                @if ($post->pilihan == 0)
                                    <form action="{{ url('/recPosts/update/' . $post->id) }}">
                                        @csrf
                                        <button onclick="return confirm('Jadikan Artikel/Berita Menjadi Berita Pilihan?')"><i
                                                id="show" class='bx bxs-star'></i></button>
                                    </form>
                                @else
                                    <form action="{{ url('/recPosts/demotion/' . $post->id) }}">
                                        @csrf
                                        <button onclick="return confirm('Hapus Berita Pilihan?')"><i id="edit"
                                                class='bx bxs-star'></i></button>
                                    </form>
                                @endif
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
            <div class="pagination">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
