<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderRequest;

class OrderRequestController extends Controller
{
    public function index()
    {
        $orders = OrderRequest::latest()->paginate(15);
        return view('Admin.orders.index', compact('orders'));
    }

    public function destroy(OrderRequest $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order request deleted successfully.');
    }
}
