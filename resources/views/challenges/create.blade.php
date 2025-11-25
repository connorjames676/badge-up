<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Challenge') }}
        </h2>
    </x-slot>

    <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <form method="POST" action="{{ route('challenges.store') }}">
            @csrf
            <p>Title: <input type="text" name="title" value="{{ old('title') }}"></p>
            <p>Description: <input type="text" name="description" value="{{ old('description') }}"></p>
            <p>Start date: <input type="date" name="start_date" value="{{ old('start_date') }}"></p>
            <p>End date: <input type="date" name="end_date" value="{{ old('end_date') }}"></p>
            <input type="submit" value="Submit">
            <a href="{{ route('challenges.index') }}">Cancel</a>
        </form>
    </div>
</x-app-layout>