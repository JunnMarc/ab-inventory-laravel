<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Purchase') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('purchases.store') }}" method="POST">
                    @csrf

                    <!-- Purchase Date, Supplier, Employee, Reference -->
                    <div class="grid grid-cols-4 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Purchase Date *</label>
                            <input type="date" name="purchase_date" class="w-full border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>

                        <!-- Supplier Selection -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Supplier *</label>
                            <select name="supplier_id" class="w-full border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->suppliers_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Employee Selection -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Recorded By (Employee) *</label>
                            <select name="employee_id" class="w-full border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Select Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Reference Field -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Reference</label>
                            <input type="text" name="reference" class="w-full border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Product Table -->
                    <div class="border rounded-lg overflow-hidden">
                        <table class="w-full bg-white border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="py-2 px-4 border">Product</th>
                                    <th class="py-2 px-4 border">Quantity</th>
                                    <th class="py-2 px-4 border">Price</th>
                                    <th class="py-2 px-4 border">Total</th>
                                    <th class="py-2 px-4 border">Action</th>
                                </tr>
                            </thead>
                            <tbody id="purchase-items">
                                <tr>
                                    <td class="py-2 px-4 border">
                                        <select name="products[]" class="w-full border-gray-300 rounded-lg p-2">
                                            <option value="">-- Choose Product --</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="py-2 px-4 border">
                                        <input type="number" name="quantities[]" class="w-full border-gray-300 rounded-lg p-2 text-center" value="1" min="1">
                                    </td>
                                    <td class="py-2 px-4 border">
                                        <input type="number" name="prices[]" class="w-full border-gray-300 rounded-lg p-2 text-center" value="0" min="0">
                                    </td>
                                    <td class="py-2 px-4 border text-center">0</td>
                                    <td class="py-2 px-4 border text-center">
                                        <button type="button" class="text-red-500" onclick="removeRow(this)">🗑</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Add Row Button -->
                    <div class="mt-4 flex justify-end">
                        <button type="button" class="bg-green-500 text-white px-4 py-2 rounded" onclick="addRow()">+</button>
                    </div>

                    <!-- Summary Section -->
                    <div class="mt-6 flex justify-between items-center">
                        <div class="text-lg font-semibold">Subtotal:</div>
                        <div class="text-lg font-semibold">₱0.00</div>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded">Purchase</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addRow() {
            let table = document.getElementById("purchase-items");
            let row = table.insertRow();
            row.innerHTML = `
                <td class="py-2 px-4 border">
                    <select name="products[]" class="w-full border-gray-300 rounded-lg p-2">
                        <option value="">-- Choose Product --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="py-2 px-4 border">
                    <input type="number" name="quantities[]" class="w-full border-gray-300 rounded-lg p-2 text-center" value="1" min="1">
                </td>
                <td class="py-2 px-4 border">
                    <input type="number" name="prices[]" class="w-full border-gray-300 rounded-lg p-2 text-center" value="0" min="0">
                </td>
                <td class="py-2 px-4 border text-center">0</td>
                <td class="py-2 px-4 border text-center">
                    <button type="button" class="text-red-500" onclick="removeRow(this)">🗑</button>
                </td>
            `;
        }

        function removeRow(button) {
            button.closest("tr").remove();
        }
    </script>
</x-app-layout>
