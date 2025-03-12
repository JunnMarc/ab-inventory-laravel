<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        $orderDetails = OrderDetail::with(['order', 'product'])->get();
        return view('order_details.index', compact('orderDetails'));
    }
}

