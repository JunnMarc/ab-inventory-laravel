<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <x-card 
                title="Sales Report" 
                description="View the latest sales trends."
                link="#" 
                color="blue" />

            <x-card 
                title="Inventory Status" 
                description="Check stock levels and inventory."
                link="#" 
                color="green" />

            <x-card 
                title="Employee Management" 
                description="Manage employee records."
                link="{{ route('employees.index') }}" 
                color="yellow" />

            <x-card 
                title="Financial Overview" 
                description="Track revenue and expenses."
                link="#" 
                color="red" />
        </div>

        <!-- Additional Content -->
        <div class="mt-10 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4">Recent Transactions</h3>

            <!-- Example Table -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">#</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Transaction</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Amount</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border border-gray-300 dark:border-gray-600 dark:text-white">
                            <td class="px-4 py-2">1</td>
                            <td class="px-4 py-2">Bakery Purchase</td>
                            <td class="px-4 py-2">$120.50</td>
                            <td class="px-4 py-2">March 10, 2025</td>
                        </tr>
                        <tr class="border border-gray-300 dark:border-gray-600 dark:text-white">
                            <td class="px-4 py-2">2</td>
                            <td class="px-4 py-2">Wholesale Order</td>
                            <td class="px-4 py-2">$450.00</td>
                            <td class="px-4 py-2">March 9, 2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <a href="{{ route('transactions.create') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                    {{ __('Create New Transaction') }}
                </a>
            </div>
        </div>

    </div>
</x-app-layout>
