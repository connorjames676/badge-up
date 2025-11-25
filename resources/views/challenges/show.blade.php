<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Challenge Details') }}
        </h2>
    </x-slot>

    <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <ul>
            <li>Title: {{ $challenge->title }}</li>
            <li>Description: {{ $challenge->description }}</li>
            <li>Start date: {{ $challenge->start_date  }}</li>
            <li>End date: {{ $challenge->end_date }}</li>
        </ul>
        <a href="{{ route('attempts.create') }}">Upload your atttempt for this challenge!</a>
    </div>
</x-app-layout>