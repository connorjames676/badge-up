<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Badges of {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 text-gray-200 shadow sm:rounded-lg">
                {{--<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight " style="margin-bottom: 20px">Challenges</h2>--}}

                @forelse ($badges as $badge)
                    <article class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800" style="margin-bottom: 10px">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    <a href="{{ route('challenges.show', $badge->challenge->id) }}">{{ $badge->title }}</a>
                                </h4>

                                <p class="mt-2 text-sm text-gray-300">
                                    {{ $badge->description }}
                                </p>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="text-gray-600 dark:text-gray-300">No badges yet.</p>
                @endforelse
                {{ $badges->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
