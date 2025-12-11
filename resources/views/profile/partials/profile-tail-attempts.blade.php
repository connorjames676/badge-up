<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Attempts</h2>
    </header>

    <div class="mt-3">
        @forelse ($attempts as $attempt)
            <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="margin-bottom: 3px;">
                <article class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                <a href="{{ route('attempts.show', $attempt->id) }}">{{ $attempt->title }}</a>
                            </h4>
                            @if(!empty($attempt->description))
                                <p class="mt-3 text-sm text-gray-700 dark:text-gray-200 line-clamp-3">
                                    {{ $attempt->description }}
                                </p>
                            @endif
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                by <a href="{{ route('profile.show', $user->id) }}">{{ $attempt->user->name ?? 'Unknown' }}</a>
                            </p>
                        </div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                            {{ $attempt->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <div class="mt-4 flex w-full items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                        @php $liked = $attempt->likes->contains('user_id', auth()->user()->id); @endphp
                        @if ($liked)
                            <form method="POST" action="{{ route('likes.destroy', $attempt->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Liked</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('likes.store', $attempt->id) }}">
                                @csrf
                                <button type="submit">Like</button>
                            </form>
                        @endif
                        
                        <a href="{{ route('comments.create', $attempt->id) }}" class="hover:text-indigo-600">Comment</a>

                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                            {{ $attempt->num_likes }} likes
                        </span>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                            {{ $attempt->num_comments }} comments
                        </span>
                    </div>

                    <div class="font-semibold mt-4 flex w-full items-center gap-3 text-m text-gray-500 dark:text-gray-400">
                        @if (auth()->user()->id == $attempt->user_id)
                            <div class="mt-4 flex w-full items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                                <a href="{{ route('attempts.edit', $attempt->id) }}">Edit</a>
                                <form method="POST" action="{{ route('attempts.destroy', $attempt->id) }}">
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
            <p class="text-gray-600 dark:text-gray-300">No attempts yet.</p>
        @endforelse
        {{ $attempts->links() }}
    </div>
</section>