@extends('layouts.app')

@section('title', 'List Siswa')
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
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->nik }}</td>
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
