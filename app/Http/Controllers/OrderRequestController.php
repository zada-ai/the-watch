<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderRequest;

class OrderRequestController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:30',
        ]);

        if (empty($data['email']) && empty($data['phone'])) {
            return response()->json(['status' => false, 'message' => 'Provide email or phone.'], 422);
        }

        $order = OrderRequest::create([
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'contact_type' => !empty($data['email']) && !empty($data['phone']) ? 'both' : (!empty($data['email']) ? 'email' : 'phone'),
            'contact_value' => $data['email'] ?? $data['phone'],
        ]);

        return response()->json(['status' => true, 'message' => 'Request received.', 'data' => $order]);
    }
}
