<x-app-layout>

    <title>BadgeUp</title>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 text-gray-200 shadow sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight " style="margin-bottom: 20px">Active challenges:</h2>
                
                @if ($joined->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">You haven't entered a challenge yet. Head to Challenges to join one!</p>
                @elseif ($active->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">No active challenges. Head to Challenges to join one!</p>
                @else
                    @foreach ($active as $challenge)
                        <article class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800" style="margin-bottom: 10px">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                        <a href="{{ route('challenges.show', $challenge->id) }}">{{ $challenge->title }}</a>
                                    </h4>

                                    <p class="mt-2 text-sm text-gray-300">
                                    {{ $challenge->description }}
                                    </p>

                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        by <a href="{{ route('profile.show', $challenge->coach_id) }}">{{ $challenge->user->name ?? 'Unknown' }}</a>
                                    </p>
                                </div>

                                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                                    @if (now()->between($challenge->start_date, $challenge->end_date))
                                        Active
                                    @elseif (now()->lt($challenge->start_date))
                                        Upcoming
                                    @else
                                        Finished
                                    @endif
                                </span>
                            </div>
                        </article>
                    @endforeach
                    {{ $active->links() }}
                @endif
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 text-gray-200 shadow sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight " style="margin-bottom: 20px">Upcoming challenges:</h2>

                @if ($joined->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">You haven't entered a challenge yet. Head to Challenges to join one!</p>
                @elseif ($upcoming->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">No upcoming challenges. Head to Challenges to join one!</p>
                @else
                    @foreach ($upcoming as $challenge)
                        <article class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800" style="margin-bottom: 10px">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                        <a href="{{ route('challenges.show', $challenge->id) }}">{{ $challenge->title }}</a>
                                    </h4>

                                    <p class="mt-2 text-sm text-gray-300">
                                    {{ $challenge->description }}
                                    </p>

                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        by <a href="{{ route('profile.show', $challenge->coach_id) }}">{{ $challenge->user->name ?? 'Unknown' }}</a>
                                    </p>
                                </div>

                                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                                    @if (now()->between($challenge->start_date, $challenge->end_date))
                                        Active
                                    @elseif (now()->lt($challenge->start_date))
                                        Upcoming
                                    @else
                                        Finished
                                    @endif
                                </span>
                            </div>
                        </article>
                    @endforeach
                    {{ $upcoming->links() }}
                @endif
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 text-gray-200 shadow sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight " style="margin-bottom: 20px">Past challenges:</h2>

                @if ($joined->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">You haven't entered a challenge yet. Head to Challenges to join one!</p>
                @elseif ($past->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">No past challenges. Head to Challenges to join one!</p>
                @else
                    @foreach ($past as $challenge)
                        <article class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800" style="margin-bottom: 10px">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                        <a href="{{ route('challenges.show', $challenge->id) }}">{{ $challenge->title }}</a>
                                    </h4>

                                    <p class="mt-2 text-sm text-gray-300">
                                    {{ $challenge->description }}
                                    </p>

                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        by <a href="{{ route('profile.show', $challenge->coach_id) }}">{{ $challenge->user->name ?? 'Unknown' }}</a>
                                    </p>
                                </div>

                                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                                    @if (now()->between($challenge->start_date, $challenge->end_date))
                                        Active
                                    @elseif (now()->lt($challenge->start_date))
                                        Upcoming
                                    @else
                                        Finished
                                    @endif
                                </span>
                            </div>
                        </article>
                    @endforeach
                    {{ $past->links() }}
                @endif
            </div>
        </div>
    </div>
</x-app-layout>