<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\InventoryMovement;
use App\Models\Products;
use App\Models\Supplier;
use App\Models\Employee;
use App\Models\PurchaseDetail;

class PurchaseController extends Controller
{
    // 🟢 LIST ALL PURCHASES
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'details.product'])->latest()->paginate(10);
        return view('purchases.index', compact('purchases'));
    }

    // 🟢 SHOW PURCHASE CREATION FORM
    public function create()
    {
        $suppliers = Supplier::all(); 
        $products = Products::all(); 
        $employees = Employee::all(); 
        return view('purchases.create', compact('suppliers', 'products', 'employees'));
    }

    // 🟢 STORE NEW PURCHASE
    public function store(Request $request)
    {
        $request->validate([
            'purchase_date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'employee_id' => 'required|exists:employees,id',
            'products' => 'required|array',
            'quantities' => 'required|array',
            'prices' => 'required|array'
        ]);

        // Create a new Purchase record
        $purchase = Purchase::create([
            'purchase_date' => $request->purchase_date,
            'supplier_id' => $request->supplier_id,
            'reference' => $request->reference,
        ]);

        foreach ($request->products as $index => $productId) {
            $quantity = $request->quantities[$index];
            $price = $request->prices[$index];

            // Add purchase details
            $purchase->details()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $price,
                'total' => $quantity * $price
            ]);

            
            $product = Products::find($productId);
            // Update Inventory Movements (STACK IN)
            // InventoryMovement::create([
            //     'product_id' => $productId,
            //     'employee_id' => $request->employee_id,
            //     'supplier_id' => $request->supplier_id,
            //     'date' => now(),
            //     'new_luto' => $quantity,
            //     'pull_out' => 0, 
            // ]);

            // Update Product Stock
            $product->increment('quantity', $quantity);
        }

        return redirect()->route('purchases.index')->with('success', 'Purchase added successfully & Inventory Updated');
    }

    // 🟢 SHOW A SINGLE PURCHASE
    public function show($id)
    {
        $purchase = Purchase::with(['supplier', 'details.product'])->findOrFail($id);
        return view('purchases.show', compact('purchase'));
    }

    // 🟢 SHOW EDIT FORM
    public function edit($id)
    {
        $purchase = Purchase::with('details')->findOrFail($id);
        $suppliers = Supplier::all();
        $products = Products::all();
        return view('purchases.edit', compact('purchase', 'suppliers', 'products'));
    }

    // 🟢 UPDATE PURCHASE
    public function update(Request $request, $id)
    {
        $request->validate([
            'purchase_date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'products' => 'required|array',
            'quantities' => 'required|array',
            'prices' => 'required|array'
        ]);

        $purchase = Purchase::findOrFail($id);
        $purchase->update([
            'purchase_date' => $request->purchase_date,
            'supplier_id' => $request->supplier_id,
            'reference' => $request->reference,
        ]);

        // Delete old purchase details
        PurchaseDetail::where('purchase_id', $id)->delete();

        foreach ($request->products as $index => $productId) {
            $quantity = $request->quantities[$index];
            $price = $request->prices[$index];

            // Add updated purchase details
            $purchase->details()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $price,
                'total' => $quantity * $price
            ]);
        }

        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully');
    }

    // 🟢 DELETE PURCHASE
    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->details()->delete(); // Delete related purchase details
        $purchase->delete(); // Delete purchase record

        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully');
    }
}
