@extends('dashboard.layouts.main')
@section('container')
    {{-- Index Category --}}
    <div class="post-wrapper">
        <div class="post">
            <div class="top">
                <div class="action">
                    <a id="blue" href="{{ url('dashboard/category/create') }}"><i class="bx bx-plus"></i> Category
                        Baru</a>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <td>Category</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $category)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $category->name }}</td>
                            <td>
                                <form action="{{ url('dashboard/category/' . $category->id . '/edit') }}">
                                    @csrf
                                    <button><i id="edit" class='bx bxs-edit-alt'></i></button>
                                </form>
                                <form action="{{ url('dashboard/category/' . $category->id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button onclick="return confirm('Hapus Category {{ $category->name }}?')"><i
                                            id="delete" class='bx bxs-trash-alt'></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    {{-- Index Category --}}
@endsection
