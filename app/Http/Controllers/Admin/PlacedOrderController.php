<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class PlacedOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::latest()->paginate(25);
        return view('Admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('Admin.orders.show', compact('order'));
    }
}
