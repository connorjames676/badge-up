<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Comment') }}
        </h2>
    </x-slot>

    <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <form method="POST" action="{{ route('comments.store', $attempt) }}">
            @csrf
            <p>Content: <input type="text" name="content" value="{{ old('content') }}"></p>
            <input type="submit" value="Submit">
            <a href="{{ route('attempts.show', $attempt->id) }}">Cancel</a>
        </form>
    </div>
</x-app-layout>
