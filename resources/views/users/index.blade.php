@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <p>The users of the Challenge Application:</p>
    <ul>
        @foreach ($users as $user)
            <li><a href="{{ route('users.show', ['id' => $user->id]) }}"> {{ $user->name }}</a></li>
        @endforeach
    </ul>
    <a href="{{ route('users.create') }}">Create User</a>
@endsection