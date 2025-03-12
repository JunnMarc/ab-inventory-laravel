<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <x-card 
                title="Sales Report" 
                description="View the latest sales trends."
                link="{{ route('inventory.sales') }}" 
                color="blue" />

            <x-card 
                title="Inventory Status" 
                description="Check stock levels and inventory."
                link="{{ route('inventory.status') }}" 
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

        <div class='py-6 max-w-7xl mx-auto sm:px-6 lg:px-1'>
            @if($lowStockAlerts->isNotEmpty())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-lg">
                    <h2 class="text-lg font-semibold mb-4 text-red-800">⚠️ Low Stock Alerts</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
                            <thead>
                                <tr class="bg-gradient-to-r from-red-500 to-red-700 text-white">
                                    <th class="px-4 py-2 text-left">Product</th>
                                    <th class="px-4 py-2 text-left">Category</th>
                                    <th class="px-4 py-2 text-left">Current Stock</th>
                                    <th class="px-4 py-2 text-left">Stock Alert Threshold</th>
                                    <th class="px-4 py-2 text-left">Stock Deficit</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($lowStockAlerts as $alert)
                                    <tr class="hover:bg-gray-100 transition">
                                        <td class="px-4 py-3 font-semibold">{{ $alert->product_name }}</td>
                                        <td class="px-4 py-3">{{ $alert->category_name }}</td>
                                        <td class="px-4 py-3 font-semibold text-red-600">{{ $alert->current_stock }}</td>
                                        <td class="px-4 py-3 font-semibold text-gray-600">{{ $alert->stock_alert_threshold }}</td>
                                        <td class="px-4 py-3 font-semibold text-yellow-600">{{ $alert->stock_deficit }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
</x-app-layout>
