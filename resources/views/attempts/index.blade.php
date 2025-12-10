<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 text-gray-200 shadow sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight " style="margin-bottom: 20px">Attempts</h2>

                @forelse ($attempts as $attempt)
                    <article class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800" style="margin-bottom: 10px">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    <a href="{{ route('attempts.show', $attempt->id) }}">{{ $attempt->title }}</a>
                                </h4>

                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    by <a href="{{ route('profile.show', $attempt->user_id) }}">{{ $attempt->user->name ?? 'Unknown' }}</a>
                                </p>
                            </div>

                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                                {{ $attempt->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </article>
                @empty
                    <p class="text-gray-600 dark:text-gray-300">No challenges yet. Be the first to create one!</p>
                @endforelse
                {{ $attempts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
