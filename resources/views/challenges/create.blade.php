<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create a Challenge</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form method="POST" action="{{ route('challenges.store') }}" class="mt-6 space-y-6">
                    @csrf
                    <div>
                        <x-input-label value="Title" />
                        <x-text-input type="text" name="title" class="mt-1 block w-full" style="margin-bottom: 5px"  :value="old( 'title')" />

                        <x-input-label value="Description" />
                        <x-text-input type="text" name="description" class="mt-1 block w-full" style="margin-bottom: 5px" :value="old( 'description')" />

                        <x-input-label value="Start Date" />
                        <x-text-input type="date" name="start_date" class="mt-1 block w-full" style="margin-bottom: 5px" :value="old( 'start_date')" />

                        <x-input-label value="End Date" />
                        <x-text-input type="date" name="end_date" class="mt-1 block w-full" style="margin-bottom: 5px" :value="old( 'end_date')" />
                    </div>
                    
                    @include('layouts.error')

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>

                    <div class="flex items-center gap-4 text-white">
                        <a href="{{ route('challenges.index') }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
