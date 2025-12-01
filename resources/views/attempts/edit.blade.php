<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Attempt
        </h2>
    </x-slot>

    <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <form method="POST" action="{{ route('attempts.update', $attempt->id) }}">
            @csrf
            @method('PATCH')
            <p>Title: <input type="text" name="title" value="{{ old('title') }}"></p>
            <p>Description: <input type="text" name="description" value="{{ old('description') }}"></p>
            <input type="submit" value="Submit">
            <a href="{{ route('attempts.show', $attempt) }}">Cancel</a>
        </form>
    </div>
</x-app-layout>
