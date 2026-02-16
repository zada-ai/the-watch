@extends('Admin.layout')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Order #{{ $order->id }}</h1>

    <div class="bg-white rounded shadow p-4">
        <p><strong>Product:</strong> {{ $order->product_name }} (ID: {{ $order->product_id }})</p>
        <p><strong>Unit price:</strong> Rs {{ number_format($order->unit_price,2) }}</p>
        <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
        <p><strong>Total price:</strong> Rs {{ number_format($order->total_price,2) }}</p>

        @if($order->selected_colors)
            <p><strong>Selected colors:</strong></p>
            <ul>
            @foreach($order->selected_colors as $c)
                <li>{{ $c }} × {{ $order->selected_color_qtys[$c] ?? 1 }}</li>
            @endforeach
            </ul>
        @endif

        <p><strong>Payment:</strong> {{ $order->payment_method }} {{ $order->payment_sub ? '('.$order->payment_sub.')' : '' }}</p>
        <p><strong>Transaction ID:</strong> {{ $order->payment_txn_id }}</p>

        <h4 class="mt-4 font-semibold">Shipping Information</h4>
        <p>{{ $order->ship_name }}<br>
        {{ $order->ship_address }}<br>
        {{ $order->ship_city }} - {{ $order->ship_postal }}<br>
        {{ $order->ship_country }}<br>
        Nearby: {{ $order->ship_nearby }}</p>

        @if($order->payment_proof_path)
            <div class="mt-4">
                <p class="font-semibold">Payment proof</p>
                <img src="{{ asset('storage/' . $order->payment_proof_path) }}" alt="proof" class="max-w-xs border" />
            </div>
        @endif
    </div>
</div>
@endsection
