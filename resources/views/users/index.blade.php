@extends('layouts.app')

@section('title', 'List of Users')
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Users') }}
        </div>

        <div class="alert alert-info" role="alert">Users List</div>

        <div class="card-body">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">NIS/NPT</th>
                    <th scope="col">Level</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->nik }}</td>
                        <td>
                            @switch($user->user_level)
                                @case('1')
                                    IT Admin
                                @break

                                @case('2')
                                    Kepsek, Wakasek
                                @break

                                @case('3')
                                    Guru
                                @break

                                @case('5')
                                    Siswa
                                @break
                            @endswitch
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

        <div class="card-footer">
            {{ $users->links() }}
        </div>
    </div>
@endsection
