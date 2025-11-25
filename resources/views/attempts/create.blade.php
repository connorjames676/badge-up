<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Attempt') }}
        </h2>
    </x-slot>

    <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <form method="POST" action="{{ route('attempts.store') }}">
            @csrf
            <p>Title: <input type="text" name="title" value="{{ old('title') }}"></p>
            <p>Description: <input type="text" name="description" value="{{ old('description') }}"></p>
            <input type="submit" value="Submit">
            <a href="{{ route('attempts.index') }}">Cancel</a>
        </form>
    </div>
</x-app-layout>