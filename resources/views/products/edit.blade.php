<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('products.update', $product->product_id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Category Name -->
                        <div class="mb-4">
                            <x-input-label for="product_name" :value="__('Product Name')" />
                            <x-text-input id="product_name" type="text" name="product_name" class="block mt-1 w-full" value="{{ old('product_name', $product->product_name) }}" required />
                        </div>

                        <!-- Product Category (Dropdown) -->
                        <div class="mb-4">
                            <x-input-label for="product_category" :value="__('Product Category')" />
                            <select id="product_category" name="product_category" class="block mt-1 w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md shadow-sm" required>
                                <option value="">{{ __('Select a Category') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="text-end">
                            <x-primary-button type="submit">
                                {{ __('Save') }}
                            </x-primary-button>
                            <x-secondary-button type="button" onclick="window.location='{{ route('products.index') }}'">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
