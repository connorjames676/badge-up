<!-- LOOK OVER THIS -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ 'Challenges' }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @forelse ($challenges as $challenge)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <a
                            href="{{ route('challenges.show', $challenge) }}"
                            class="block bg-slate-900 border border-slate-700 rounded-xl p-5
                                   hover:border-indigo-400 hover:-translate-y-1 hover:shadow-lg
                                   transition duration-150 ease-out">
                            {{-- Title + sport --}}
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-200">
                                        {{ $challenge->title }}
                                    </h3>

                                    <p class="mt-2 text-sm text-gray-300">
                                        {{ \Illuminate\Support\Str::limit($challenge->description, 120) }}
                                    </p>
                                </div>
                            </div>

                            {{-- Dates + status --}}
                            <div class="mt-4 flex items-center justify-between text-xs text-gray-400">
                                <span>
                                    {{ $challenge->start_date }}
                                    &ndash;
                                    {{ $challenge->end_date }}
                                </span>

                                <span class="font-semibold
                                    @if(now()->between($challenge->start_date, $challenge->end_date))
                                        text-emerald-400
                                    @elseif(now()->lt($challenge->start_date))
                                        text-amber-300
                                    @else
                                        text-gray-400
                                    @endif
                                ">
                                    @if(now()->between($challenge->start_date, $challenge->end_date))
                                        Active
                                    @elseif(now()->lt($challenge->start_date))
                                        Upcoming
                                    @else
                                        Finished
                                    @endif
                                </span>
                            </div>

                            {{-- Small footer: coach / attempts count (optional) --}}
                            {{--<div class="mt-3 flex items-center justify-between text-[11px] text-gray-500">
                                <span>
                                    Coach: {{ $challenge->coach->name ?? 'Unknown' }}
                                </span>
                                <span>
                                    {{ $challenge->attempts_count ?? $challenge->attempts->count() }} attempts
                                </span>
                            </div>--}}

                            <!-- Add form to this so that a new route can be accessed! -->
                            <button
                                type="submit"
                                class="w-full text-center bg-indigo-600 text-white text-sm font-semibold py-2 rounded-lg hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                Join
                            </button>
                        </a>
                </div>
            @empty
                <p class="text-gray-200 text-sm">
                    No challenges have been created yet.
                </p>
            @endforelse


            {{-- @if($challenges->isEmpty())
                <p class="text-gray-200 text-sm">
                    No challenges have been created yet.
                </p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($challenges as $challenge)
                        <a
                            href="{{ route('challenges.show', $challenge) }}"
                            class="block bg-slate-900 border border-slate-700 rounded-xl p-5
                                   hover:border-indigo-400 hover:-translate-y-1 hover:shadow-lg
                                   transition duration-150 ease-out">
                            
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-200">
                                        {{ $challenge->title }}
                                    </h3>

                                    <p class="mt-2 text-sm text-gray-300">
                                        {{ \Illuminate\Support\Str::limit($challenge->description, 120) }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4 flex items-center justify-between text-xs text-gray-400">
                                <span>
                                    {{ $challenge->start_date }}
                                    &ndash;
                                    {{ $challenge->end_date }}
                                </span>

                                <span class="font-semibold
                                    @if(now()->between($challenge->start_date, $challenge->end_date))
                                        text-emerald-400
                                    @elseif(now()->lt($challenge->start_date))
                                        text-amber-300
                                    @else
                                        text-gray-400
                                    @endif
                                ">
                                    @if(now()->between($challenge->start_date, $challenge->end_date))
                                        Active
                                    @elseif(now()->lt($challenge->start_date))
                                        Upcoming
                                    @else
                                        Finished
                                    @endif
                                </span>
                            </div>

                            <div class="mt-3 flex items-center justify-between text-[11px] text-gray-500">
                                <span>
                                    Coach: {{ $challenge->coach->name ?? 'Unknown' }}
                                </span>
                                <span>
                                    {{ $challenge->attempts_count ?? $challenge->attempts->count() }} attempts
                                </span>
                            </div>

                            <!-- Add form to this so that a new route can be accessed! -->
                            <button
                                type="submit"
                                class="w-full text-center bg-indigo-600 text-white text-sm font-semibold py-2 rounded-lg hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                Join
                            </button>
                        </a>
                    @endforeach
                </div>
            @endif --}}
        </div>
    </div>
</x-app-layout>
