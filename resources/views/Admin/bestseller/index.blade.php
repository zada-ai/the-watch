<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Sellers Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-white p-6 flex flex-col">
            <h2 class="text-2xl font-bold mb-8">Admin Panel</h2>
            <nav class="flex-1 space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
                    📊 Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
                    📦 Products
                </a>
                <a href="{{ route('admin.bestseller.index') }}" class="block px-4 py-2 rounded bg-amber-500 hover:bg-amber-600">
                    ⭐ Best Sellers
                </a>
                <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
                    📋 Order Requests
                </a>
            </nav>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full px-4 py-2 rounded bg-red-600 hover:bg-red-700">
                    🚪 Logout
                </button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="bg-white shadow-md p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800">🌟 Best Sellers Management</h1>
                <p class="text-gray-600">Manage your best sellers products</p>
            </div>

            <div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">🌟 Best Sellers Management</h1>
        <a href="{{ route('admin.bestseller.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg transition">
            + Add Best Seller
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Category</th>
                        <th class="px-6 py-3 text-left">Original Price</th>
                        <th class="px-6 py-3 text-left">Sale Price</th>
                        <th class="px-6 py-3 text-left">Discount</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($bestsellers as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-bold">{{ $item->id }}</td>
                            <td class="px-6 py-4">{{ $item->name }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-white text-sm font-semibold
                                    @if($item->category == 'watches') bg-amber-500
                                    @elseif($item->category == 'headphones') bg-blue-500
                                    @else bg-purple-500
                                    @endif">
                                    {{ ucfirst($item->category) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">Rs {{ number_format($item->orig_price) }}</td>
                            <td class="px-6 py-4">Rs {{ number_format($item->sale_price) }}</td>
                            <td class="px-6 py-4 font-bold text-red-600">-{{ $item->discount }}%</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.bestseller.toggle', $item) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 rounded text-white text-sm
                                        @if($item->active) bg-green-500 hover:bg-green-600
                                        @else bg-red-500 hover:bg-red-600
                                        @endif">
                                        {{ $item->active ? '✓ Active' : '✗ Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.bestseller.edit', $item) }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded text-sm mr-2 transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.bestseller.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded text-sm transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                                No best sellers found. <a href="{{ route('admin.bestseller.create') }}" class="text-blue-600 hover:underline">Create one now!</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $bestsellers->links() }}
    </div>
            </div>
        </div>
    </div>
</body>
</html>
