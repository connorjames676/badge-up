<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Challenges') }}
        </h2>
    </x-slot>

    <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <ul>
        @foreach ($challenges as $challenge)
            <li><a href="{{ route('challenges.show', ['id' => $challenge->id]) }}">{{ $challenge->title }}</a></li>
        @endforeach
        </ul>
        <a href="{{ route('challenges.create') }}">Create Challenge</a>
    </div>
</x-app-layout>