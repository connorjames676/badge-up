<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ $user->name }}
        </h2>

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
