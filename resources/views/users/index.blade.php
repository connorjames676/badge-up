@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <p>The users of the Challenge Application</p>
    <ul>
        @foreach ($users as $user)
            <li>{{$user->name}}</li>
        @endforeach
    </ul>
@endsection