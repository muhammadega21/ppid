@extends('dashboard.layouts.main')
@section('container')
    <div class="post-wrapper">
        <div class="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <td>Nama</td>
                        <td>Username</td>
                        <td>Level</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @php
                            if ($user->level == 1) {
                                $level = 'Admin';
                            }
                            if ($user->level == 2) {
                                $level = 'Creator';
                            }
                            if ($user->level == 3) {
                                $level = 'Guest';
                            }
                        @endphp
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $level }}</td>
                            <td>
                                @if ($user->level == 1)
                                    <i id="show" class='bx bxs-user-check' style="background-color: var(--darkblue)"></i>
                                @else
                                    @if ($user->level == 2)
                                        <form action="{{ url('users/demotion/' . $user->id) }}" method="POST">
                                            @method('put')
                                            @csrf
                                            <button onclick="return confirm('Ubah {{ $user->name }} menjadi Guest?')"><i
                                                    id="show" class='bx bxs-user-check'></i></button>
                                        </form>
                                    @endif
                                    @if ($user->level == 3)
                                        <form action="{{ url('users/update/' . $user->id) }}" method="POST">
                                            @method('put')
                                            @csrf
                                            <button onclick="return confirm('Ubah {{ $user->name }} menjadi Creator?')"><i
                                                    id="edit" class='bx bxs-user'></i></button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
