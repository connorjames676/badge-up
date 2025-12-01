<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Comment
        </h2>
    </x-slot>

    <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <form method="POST" action="{{ route('comments.update', [$attempt, $comment]) }}">
            @csrf
            @method('PATCH')
            <p>Content: <input type="text" name="content" value="{{ old('content') }}"></p>
            <input type="submit" value="Submit">
            <a href="{{ route('attempts.show', $attempt) }}">Cancel</a>
        </form>
    </div>
</x-app-layout>
