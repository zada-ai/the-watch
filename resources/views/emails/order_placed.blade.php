<div style="font-family:Arial, sans-serif; line-height:1.4; color:#111;">
    <h2>New Order Received</h2>
    <p>Order ID: {{ $order->id }}</p>
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

    <p><strong>Payment method:</strong> {{ $order->payment_method }} {{ $order->payment_sub ? '('.$order->payment_sub.')' : '' }}</p>
    <p><strong>Transaction ID:</strong> {{ $order->payment_txn_id }}</p>

    <h4>Shipping Information</h4>
    <p>{{ $order->ship_name }}<br>
    {{ $order->ship_address }}<br>
    {{ $order->ship_city }} - {{ $order->ship_postal }}<br>
    {{ $order->ship_country }}<br>
    Nearby: {{ $order->ship_nearby }}</p>

    <p>Buyer email: {{ $order->buyer_email }} | Phone: {{ $order->buyer_phone }}</p>

    <p>-- This is an automated notification.</p>
</div>
