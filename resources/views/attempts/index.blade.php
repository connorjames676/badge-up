<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Attempts') }}
        </h2>
    </x-slot>

    <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <ul>
        @foreach ($attempts as $attempt)
            <li>{{ $attempt->title }}</li>
        @endforeach
        </ul>
        <a href="{{ route('attempts.create') }}">Create Attempt</a>
    </div>
</x-app-layout>
