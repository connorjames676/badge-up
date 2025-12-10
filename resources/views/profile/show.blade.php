@if ($isAdmin)
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100" style="margin-bottom: 10px;">
                            {{ $user->name }} - Admin
                        </h2>

                        <p class="mt-1 text-m text-gray-600 dark:text-gray-400">
                            Admin's do not have profiles.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w">
                        @include('profile.partials.profile-head')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    @include('profile.partials.profile-tail-attempts')
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    @include('profile.partials.profile-tail-comments')
                </div>

                {{--<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    @include('profile.partials.profile-tail', [$user, $items])
                </div>--}}
            </div>
        </div>
    </x-app-layout>
@endif