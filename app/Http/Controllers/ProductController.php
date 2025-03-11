<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller {
    
    // Display all products
    public function index() {
        $products = Products::with('category')->paginate(10);
        return view('products.index', compact('products'));
    }

    // Show create form
    public function create() {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Store a new product
    public function store(Request $request) {
        $request->validate([
            'product_name' => 'required|string|max:50',
            'category_id' => 'nullable|string|exists:categories,id',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'stock_alert_threshold' => 'required|integer|min:0',
        ]);
    
        Products::create([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'quantity' => $request->quantity,
            'stock_alert_threshold' => $request->stock_alert_threshold
        ]);
    
        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    // Show edit form
    public function edit(Products $product) {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // Update product
    public function update(Request $request, Products $product) {
        $request->validate([
            'product_name' => 'required|string|max:50',
            'category_id' => 'nullable|string|max:11|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'stock_alert_threshold' => 'required|integer|min:0'
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy(Products $product) {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
