@php
    use App\Models\Attempt;
@endphp

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Comments</h2>
    </header>

    <div class="mt-3">
        @forelse ($comments as $comment)
            <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <article class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-start justify-between gap-3">
                        @php
                            $attempt = Attempt::findOrFail($comment->attempt_id)
                        @endphp
                        <div>
                            <p class="mt-3 text-sm text-gray-700 dark:text-gray-200 line-clamp-3">
                                <a href="{{ route('attempts.show', $comment->attempt_id) }}">
                                    {{ $comment->content }}
                                </a>
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                by <a href="">{{ $comment->user->name ?? 'Unknown'}}</a>
                            </p>
                        </div>

                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                            {{ $comment->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <div class="font-semibold mt-4 flex w-full items-center gap-3 text-m text-gray-500 dark:text-gray-400">
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
                    </div>
                </article>
            </div>
        @empty
            <p class="text-gray-600 dark:text-gray-300">No comments yet.</p>
        @endforelse
        {{ $comments->links() }}
    </div>
</section>
