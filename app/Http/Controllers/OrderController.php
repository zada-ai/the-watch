<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedMail;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required',
            'product_name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'shipName' => 'required|string',
            'shipAddress' => 'required|string',
            'shipCity' => 'required|string',
            'payment' => 'required|string',
            'payment_sub' => 'nullable|string',
            'payment_transaction_id' => 'nullable|string',
            'payment_proof' => 'nullable|file|image|max:5120'
        ]);

        // collect selected colors if present
        $selectedColors = $request->input('selected_colors', []);
        $selectedColorQtys = $request->input('selected_color_qtys', []);

        // store payment proof if provided
        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $proofPath = $file->store('order_proofs', 'public');
        }

        $order = Order::create([
            'product_type' => $request->input('product_type'),
            'product_id' => $request->input('product_id'),
            'product_name' => $request->input('product_name'),
            'unit_price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'total_price' => $request->input('price') * intval($request->input('quantity')),
            'orig_price' => $request->input('orig_price'),
            'selected_colors' => $selectedColors,
            'selected_color_qtys' => $selectedColorQtys,
            'payment_method' => $request->input('payment'),
            'payment_sub' => $request->input('payment_sub'),
            'payment_txn_id' => $request->input('payment_transaction_id'),
            'payment_proof_path' => $proofPath,
            'ship_name' => $request->input('shipName'),
            'ship_address' => $request->input('shipAddress'),
            'ship_city' => $request->input('shipCity'),
            'ship_nearby' => $request->input('shipNearby'),
            'ship_postal' => $request->input('shipPostal'),
            'ship_country' => $request->input('shipCountry'),
            'buyer_email' => $request->input('buyer_email'),
            'buyer_phone' => $request->input('buyer_phone'),
        ]);

        // send email to configured recipient
        try {
            $recipient = config('mail.from.address') ?: env('MAIL_USERNAME');
            // Queue the mail to avoid delaying the HTTP response
            Mail::to($recipient)->queue(new OrderPlacedMail($order, $proofPath ? Storage::disk('public')->path($proofPath) : null));
        } catch (\Exception $e) {
            // don't fail order creation on mail/queue errors; log instead
            logger('Order mail queue failed: '.$e->getMessage());
        }

        return response()->json(['status' => true, 'message' => 'Order placed successfully.', 'data' => $order]);
    }
}
