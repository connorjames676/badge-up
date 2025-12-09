<section>
    <header>
        <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100" style="margin-bottom: 10px;">
            <div class="flex justify-between">
                {{ $user->name }} - 
                @if ($user->role == 'admin')
                    Admin
                @elseif ($user->role == 'coach')
                    Coach
                @else
                    Participant
                @endif

                @if (auth()->user()->role == 'admin')
                    <form method="POST" action="{{ route('user.destroy', $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="flex items-center gap-4">
                            <x-primary-button>Remove User</x-primary-button>
                        </div>
                    </form>
                @endif
            </div>
        </h2>

        <p class="mt-1 text-m text-gray-800 dark:text-gray-200">
            Age: {{ $user->age }}
        </p>

        <p class="mt-1 text-m text-gray-600 dark:text-gray-400">
            {{ $user->profile->bio }}
        </p>
    </header>

    @if ($user->id == auth()->user()->id)
        <div class="mt-3">
        <x-primary-button>
            <a href="{{ route('bio.edit', auth()->user()->profile) }}">Edit Bio</a>
        </x-primary-button>
    </div>
    @endif

    <div class="mt-3">
        <p class="mt-1 text-m text-gray-600 dark:text-gray-400">
            {{ $user->profile->number_of_badges }} badges
        </p>
    </div>
</section>
