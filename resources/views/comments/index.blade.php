<div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="margin-bottom: 10px;">
        Comments
    </h2>
    @forelse ($attempt->comments as $comment)
        <article class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800" style="margin-bottom: 5px;">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="mt-3 text-sm text-gray-700 dark:text-gray-200 line-clamp-3">
                        {{ $comment->content }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        by <a href="{{ route('profile.show', $comment->user_id) }}">{{ $comment->user->name }}</a>
                    </p>
                </div>

                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                    {{ $comment->created_at->diffForHumans() }}
                </span>
            </div>

            @if (auth()->user()->id == $comment->user_id)
                <div class="mt-4 flex w-full items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                    <a href="{{ route('comments.edit', [$attempt, $comment]) }}">Edit</a>
                
                    <form method="POST" action="{{ route('comments.destroy', [$attempt, $comment]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </div>
            @endif
        </article>
    @empty
        <p class="text-gray-600 dark:text-gray-300">No comments yet. Be the first to comment!</p>
    @endforelse
</div>
