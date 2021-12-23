@extends('layouts.app')
@section('title', 'Welcome to Class Page')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Dashboard') }}
        </div>
        <div class="card-body">
            {{ __('You are logged in!') }}
        </div>
    </div>
@endsection
