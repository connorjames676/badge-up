@extends('layouts.app')

@section('title', 'User Details')

@section('content')
    <ul>
        <li>Name: {{ $user->name }}</li>
        <li>Age: {{ $user->age }}</li>
        <li>Role: {{ $user->role }}</li>
        <li>Email: {{ $user->email }}</li>
    </ul>
@endsection
