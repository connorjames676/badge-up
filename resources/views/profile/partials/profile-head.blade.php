<section class="flex justify-between">
    <div>
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
                <a href="{{ route('badges.index', $user) }}">{{ $user->profile->number_of_badges }} badges</a>
            </p>
        </div>
    </div>

    <div>
        @if (!$user->image == Null)
            {{--<img src="{{ asset('images/'.$user->image) }}" class="w-36 aspect-square rounded-full object-cover shrink-0">--}}
            <img src="{{ asset('images/'.$user->image) }}" class="profile-pic">
            {{--<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 text-gray-200 shadow sm:rounded-lg">
                <img src="{{ asset('images/'.$user->image) }}">
            </div>--}}
        @endif
    </div>

    @if ($user->id == auth()->user()->id)
        <div>
            <form method="POST" action="{{ route('image.upload', $user->id) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf
                    @method('PATCH')
                    <div>
                        <x-input-label value="Image" style="margin-bottom: 3px;" />
                        <input type="file" name="image">
                    </div>

                    @include('layouts.error')

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Upload profile picture') }}</x-primary-button>
                    </div>
                </form>
        </div>
    @endif
</section>
