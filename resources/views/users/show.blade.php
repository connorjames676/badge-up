<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <ul>
            <li>Name: {{ $user->name }}</li>
            <li>Age: {{ $user->age }}</li>
            <li>Role: {{ $user->role }}</li>
            <li>Email: {{ $user->email }}</li>
        </ul>
    </div>
</x-app-layout>