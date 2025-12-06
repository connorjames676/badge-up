<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Challenge Details</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex items-start justify-between gap-3" style="margin-bottom: 10px">
                <span class="rounded-full bg-gray-100 px-3 py-1 text-s font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                    @if (now()->between($challenge->start_date, $challenge->end_date))
                        Active
                    @elseif (now()->lt($challenge->start_date))
                        Upcoming
                    @else
                        Finished
                    @endif
                </span>
                 
                @if ($hasJoined == True)
                    <form method="GET" action="{{ route('attempts.create', $challenge->id) }}">
                        <div class="flex items-center gap-4">
                            <x-primary-button>Create an Attempt!</x-primary-button>
                        </div>
                    </form>
                @endif
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div style="margin-bottom: 20px">
                    <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100">{{ $challenge->title }}</h2>
                    <p class="mt-1 text-m text-gray-600 dark:text-gray-300">{{ $challenge->description }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        by <a href="">{{ $challenge->user->name}}</a>
                    </p>
                </div>

                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="mt-1 text-sm text-gray 900 dark:text-gray-100">Start Date: {{ $challenge->start_date }}</p>
                        <p class="mt-1 text-sm text-gray 900 dark:text-gray-100">End Date: {{ $challenge->end_date }}</p>
                    </div>

                    @if ($hasJoined == False)
                        <form method="POST" action="{{ route('challenge.join', $challenge->id)}}">
                            @csrf
                            @method('PATCH')
                            <div class="flex items-center gap-4">
                                <x-primary-button>Join</x-primary-button>
                            </div>
                        </form>
                    @else
                        <form method="POST" action="{{ route('challenge.leave', $challenge->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="flex items-center gap-4">
                                <x-primary-button>Leave challenge</x-primary-button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
            
            <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
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
        </div>
    </div>
</x-app-layout>
