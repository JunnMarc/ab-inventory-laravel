<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('employees.store') }}">
                        @csrf

                        <!-- Category Name -->
                        <div class="mb-4">
                            <x-input-label for="employee_fname" :value="__('First Name')" />
                            <x-text-input id="employee_fname" type="text" name="employee_fname" class="block mt-1 w-full" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="employee_lname" :value="__('Last Name')" />
                            <x-text-input id="employee_lname" type="text" name="employee_lname" class="block mt-1 w-full" required />
                        </div>

                        <!-- Buttons -->
                        <div class="text-end">
                            <x-primary-button type="submit">
                                {{ __('Save') }}
                            </x-primary-button>
                            <x-secondary-button type="button" onclick="window.location='{{ route('employees.index') }}'">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
