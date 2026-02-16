@extends('Admin.layout')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Placed Orders</h1>

    <div class="bg-white rounded shadow p-4">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">ID</th>
                    <th class="p-2 text-left">Product</th>
                    <th class="p-2 text-left">Qty</th>
                    <th class="p-2 text-left">Total</th>
                    <th class="p-2 text-left">Payment</th>
                    <th class="p-2 text-left">Buyer</th>
                    <th class="p-2 text-left">Placed At</th>
                    <th class="p-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $o)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-2">{{ $o->id }}</td>
                        <td class="p-2">{{ $o->product_name }}</td>
                        <td class="p-2">{{ $o->quantity }}</td>
                        <td class="p-2">Rs {{ number_format($o->total_price,2) }}</td>
                        <td class="p-2">{{ $o->payment_method }} {{ $o->payment_sub ? '('.$o->payment_sub.')' : '' }}</td>
                        <td class="p-2">{{ $o->ship_name }} @if($o->buyer_phone)<br>{{ $o->buyer_phone }}@endif</td>
                        <td class="p-2">{{ $o->created_at->format('Y-m-d H:i') }}</td>
                        <td class="p-2">
                            <a href="{{ route('admin.placed-orders.show', $o->id) }}" class="text-blue-600 hover:underline">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="p-4 text-center text-gray-500">No orders yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $orders->links() }}</div>
    </div>
</div>
@endsection
