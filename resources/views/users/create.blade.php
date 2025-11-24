<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <p>Name: <input type="text" name="name" value="{{ old('name') }}"></p>
            <p>Age: <input type="text" name="age" value="{{ old('age') }}"></p>
            <p>Role: <input type="text" name="role" value="{{ old('role') }}"></p>
            <p>Email: <input type="text" name="email" value="{{ old('email') }}"></p>
            <p>Password: <input type="text" name="password" value="{{ old('password') }}"></p>
            <input type="submit" value="Submit">
            <a href="{{ route('users.index') }}">Cancel</a>
        </form>
    </div>
</x-app-layout>