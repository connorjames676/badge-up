<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Attempts') }}
        </h2>
    </x-slot>

    <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <x-primary-button class="ms-3">
            <a href="{{ route('attempts.create') }}">Upload your attempt!</a>
        </x-primary-button>

        @forelse ($attempts as $attempt)
            <article class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            <a href="{{ route('attempts.show', $attempt->id) }}">{{ $attempt->title }}</a>
                        </h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            by <a href="http://localhost/attempts">{{ $attempt->user->name ?? 'Unknown' }}</a>
                        </p>
                    </div>
                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                        {{ $attempt->created_at->diffForHumans() }}
                </span>
                </div>
            </article>
        @empty
            <p class="text-gray-600 dark:text-gray-300">No attempts yet. Be the first to post one!</p>
        @endforelse
    </div>
</x-app-layout>
