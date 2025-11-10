@extends('layouts.app')

@section('title', 'Create User')

@section('content')
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <p>Name: <input type="text" name="name" ></p>
        <p>Age: <input type="text" name="age" ></p>
        <p>Role: <input type="text" name="age" ></p>
        <p>Email: <input type="text" name="email" ></p>
        <p>Password: <input type="text" name="password" ></p>
        <input type="submit" value="Submit">
        <a href="{{ route('users.index') }}">Cancel</a>
    </form>