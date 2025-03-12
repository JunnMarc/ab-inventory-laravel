<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Products;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function create()
    {
        return view('orders.create', [
            'customers' => Customer::all(),
            'employees' => Employee::all(),
            'products' => Products::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'employee_id' => 'required|exists:employees,id',
            'order_date' => 'required|date',
            'payment_type' => 'required|in:Cash,Card,Online',
            'product_id' => 'required|array',
            'product_id.*' => 'required|exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
            'price' => 'required|array',
            'price.*' => 'required|numeric|min:0',
        ]);
    
        // Initialize total calculations
        $totalProducts = 0;
        $totalPrice = 0;
    
        foreach ($request->product_id as $index => $productId) {
            $quantity = $request->quantity[$index];
            $price = $request->price[$index];
            $totalPrice += $quantity * $price;
            $totalProducts += $quantity;
        }

        $date = Carbon::parse($request->order_date)->format('Y-m-d');
    
        // Now include total_products in the order creation
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'employee_id' => $request->employee_id,
            'order_date' => $date,
            'total' => $totalPrice, 
            'total_products' => $totalProducts,
        ]);
    
        // Insert order details
        foreach ($request->product_id as $index => $productId) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'unit_cost' => $price,
                'total' => $quantity * $price,
            ]);;
        }
    
        return redirect()->route('inventory.status')->with('success', 'Order created successfully!');
    }
    
}

