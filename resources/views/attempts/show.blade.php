<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $attempt->title }}
        </h2>
    </x-slot>

    <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <article class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        {{--<h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ $attempt->title }}
                        </h4>--}}
                        @if(!empty($attempt->description))
                            <p class="mt-3 text-sm text-gray-700 dark:text-gray-200 line-clamp-3">
                                {{ $attempt->description }}
                            </p>
                        @endif
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            by {{ $attempt->user->name ?? 'Unknown' }}
                        </p>
                    </div>
                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                        {{ $attempt->created_at->diffForHumans() }}
                </span>
                </div>

                {{-- <div class="mt-4 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400"></div>
                <div class="flex gap-3">
                    <a href="#" class="hover:text-indigo-600">Like</a>
                    <a href="#" class="hover:text-indigo-600">Comment</a>
                    <a href="{{ route('attempts.edit', $attempt->id) }}" class="ml-auto hover:text-indigo-600">Edit</a>
                </div>--}}

                <div class="mt-4 flex w-full items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                    <div>
                        <a href="#" class="hover:text-indigo-600">Like</a>
                        <a href="{{ route('comments.create', $attempt->id) }}" class="hover:text-indigo-600">Comment</a>
                    </div>
                    <div>
                        <a href="{{ route('attempts.edit', $attempt->id) }}">Edit</a>
                    </div>
                    <div>
                        <form method="POST" action="{{ route('attempts.destroy', $attempt->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                        {{ $attempt->num_likes }} likes
                    </span>
                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                        {{ $attempt->num_comments }} comments
                    </span>
                </div>
            </article>



        {{-- @forelse ($attempts as $attempt)
            <article class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ $attempt->title }}
                        </h4>
                        @if(!empty($attempt->description))
                            <p class="mt-3 text-sm text-gray-700 dark:text-gray-200 line-clamp-3">
                                {{ $attempt->description }}
                            </p>
                        @endif
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            by {{ $attempt->user->name ?? 'Unknown' }}
                        </p>
                    </div>
                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                        {{ $attempt->created_at->diffForHumans() }}
                    </span>
                </div>

                <div class="mt-4 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400"></div>
                <div class="flex gap-3">
                    <a href="#" class="hover:text-indigo-600">Like</a>
                    <a href="#" class="hover:text-indigo-600">Comment</a>
                </div>
            </article>
        @empty
            <p class="text-gray-600 dark:text-gray-300">No attempts yet. Be the first to post one!</p>
        @endforelse--}}
    </div>

    <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{--@forelse ($attempt->comments as $comment)
            {{ $comment->content }}
        @empty
            <p class="text-gray-600 dark:text-gray-300">No comments yet. Be the first to comment by clicking 'comment' above!</p>    
        @endforelse--}}

        @include('comments.index', $attempt)
    </div>
</x-app-layout>
