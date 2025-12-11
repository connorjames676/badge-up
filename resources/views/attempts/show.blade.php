<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Attempt posted to 
            <span class="rounded-full bg-gray-100 px-3 py-1 text-xl font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                <a href="{{ route('challenges.show', $attempt->challenge->id) }}">
                    {{ $attempt->challenge->title }}
                </a>
            </span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div style="margin-bottom: 10px">
                    <div class="flex justify-between">
                        <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100">{{ $attempt->title }}</h2>

                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                            {{ $attempt->created_at->diffForHumans() }}
                        </span>
                    </div>
                    
                    @if(!empty($attempt->description))
                        <p class="mt-1 text-m text-gray-600 dark:text-gray-300">
                            {{ $attempt->description }}
                        </p>
                    @endif
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        by <a href="{{ route('profile.show', $attempt->user_id) }}">{{ $attempt->user->name ?? 'Unknown' }}</a>
                    </p>

                    @if ($attempt->image)
                        {{--<img src="{{ asset('storage/'.$attempt->image) }}" alt="{{ $attempt->title }}" class="mt-3 rounded">--}}
                        <img src="{{ Storage::disk('public')->url($attempt->image) }}" alt="{{ $attempt->title }}" class="mt-3 rounded">
                        
                    @endif
                    {{-- <img src="{{ Storage::url($attempt->image) }}">--}}
                </div>
            
                <div class="flex justify-between">
                    <div class="mt-4 flex w-full items-center gap-3 text-m text-gray-500 dark:text-gray-400">
                    @php $liked = $attempt->likes->contains('user_id', auth()->user()->id); @endphp
                    @if (!$isAdmin)
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
                        {{-- <a href="{{ route('comments.create', $attempt->id) }}" class="hover:text-indigo-600">Comment</a> --}}
                    @endif

                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                        {{ $attempt->num_likes }} likes
                    </span>
                    {{--<span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                        {{ $attempt->num_comments }} comments
                    </span>--}}
                    </div>

                    @if (auth()->user()->id == $attempt->challenge->user->id AND !$hasBeenApproved)
                        <form method="POST" action="{{ route('attempts.approve', $attempt->id) }}">
                                @csrf
                                @method('PATCH')
                                <x-primary-button>Approve</x-primary-button>
                        </form>

                        {{--<a href="{{ route('attempts.approve', $attempt->id) }}"><x-primary-button>Approve</x-primary-button></a>--}}
                    @endif
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
                    @elseif (auth()->user()->role == 'admin')
                        <div class="mt-4 flex w-full items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                            <form method="POST" action="{{ route('attempts.destroy', $attempt->id) }}">
                                @csrf
                                @method('DELETE')
                                <x-primary-button>Remove Attempt</x-primary-button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <livewire:create-comment :attempt_id="$attempt->id" />
            {{--@include('comments.index', $comments)--}}
        </div>
    </div>
</x-app-layout>
