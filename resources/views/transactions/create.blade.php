<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('transactions.store') }}" method="POST">
                        <div class="mb-4">
                            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded">
                                Save Transaction
                            </button>
                        </div>
                        @csrf
                        <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-lg">
                            <thead class="bg-gray-200 text-black dark:bg-gray-700 dark:text-white">
                                <tr>
                                    <th class="px-4 py-3 border-b text-left">Product</th>
                                    <th class="px-4 py-3 border-b text-left">Quantity</th>
                                    <th class="px-4 py-3 border-b text-left">Price</th>
                                    <th class="px-4 py-3 border-b text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-white" id="transaction-items">
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-4 py-3">
                                        <select name="transactions[0][product_id]" class="border rounded p-2 product-select w-full">
                                            <option value="">-- Select Product --</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                                    {{ $product->product_name }} (₱{{ $product->price }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="number" name="transactions[0][quantity]" class="border rounded p-2 quantity-input w-20 text-center" min="1" value="1">
                                    </td>
                                    <td class="px-4 py-3 price">₱0.00</td>
                                    <td class="px-4 py-3 text-center">
                                        <button type="button" class="bg-red-500 text-white px-3 py-1 rounded remove-item">Remove</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>                                          

                        <div class="flex justify-between items-center mt-4">
                            <button type="button" id="add-item" class="bg-blue-500 text-white px-4 py-2 rounded">
                                + Add Product
                            </button>

                            <h2 class="text-xl font-bold">Total: ₱<span id="total-price">0.00</span></h2>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let transactionIndex = 1;

            function updateTotal() {
                let total = 0;
                document.querySelectorAll("#transaction-items tr").forEach(row => {
                    let quantity = row.querySelector(".quantity-input").value;
                    let price = row.querySelector(".product-select").selectedOptions[0].dataset.price || 0;
                    let totalPrice = quantity * price;
                    row.querySelector(".price").innerText = `₱${totalPrice.toFixed(2)}`;
                    total += totalPrice;
                });
                document.getElementById("total-price").innerText = total.toFixed(2);
            }

            document.getElementById("add-item").addEventListener("click", function () {
                let newRow = document.querySelector("#transaction-items tr").cloneNode(true);
                newRow.querySelector(".product-select").setAttribute("name", `transactions[${transactionIndex}][product_id]`);
                newRow.querySelector(".quantity-input").setAttribute("name", `transactions[${transactionIndex}][quantity]`);
                newRow.querySelector(".quantity-input").value = 1;
                newRow.querySelector(".price").innerText = "₱0.00";
                document.getElementById("transaction-items").appendChild(newRow);
                transactionIndex++;
            });

            document.getElementById("transaction-items").addEventListener("click", function (event) {
                if (event.target.classList.contains("remove-item")) {
                    event.target.closest("tr").remove();
                    updateTotal();
                }
            });

            document.getElementById("transaction-items").addEventListener("input", function (event) {
                if (event.target.classList.contains("product-select") || event.target.classList.contains("quantity-input")) {
                    updateTotal();
                }
            });

            updateTotal();
        });
    </script>
</x-app-layout>
