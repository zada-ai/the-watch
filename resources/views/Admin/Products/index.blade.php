<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-white p-6 flex flex-col">
            <h2 class="text-2xl font-bold mb-8">Admin Panel</h2>
            <nav class="flex-1 space-y-4">
                <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 rounded bg-amber-500 hover:bg-amber-600">
                    📦 Products
                </a>
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
                    📊 Dashboard
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
                <h1 class="text-3xl font-bold text-gray-800">Products Management</h1>
                <p class="text-gray-600">Manage your product inventory</p>
            </div>

            <div class="p-6">
                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                <!-- Add Product Button -->
                <div class="mb-6">
                    <a href="{{ route('admin.products.create') }}" class="inline-block px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white font-semibold rounded-lg">
                        ➕ Add New Product
                    </a>
                </div>

                <!-- Products Table -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold">ID</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Category</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Price</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                                <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $product->id }}</td>
                                    <td class="px-6 py-4">{{ $product->name }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                            @if($product->category === 'watches') bg-blue-100 text-blue-800
                                            @elseif($product->category === 'headphones') bg-purple-100 text-purple-800
                                            @else bg-pink-100 text-pink-800
                                            @endif">
                                            {{ ucfirst($product->category) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">Rs {{ number_format($product->price) }}</td>
                                    <td class="px-6 py-4">
                                        @if($product->active)
                                            <span class="text-green-600 font-semibold">✓ Active</span>
                                        @else
                                            <span class="text-red-600 font-semibold">✗ Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="inline-block px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded text-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                        No products found. <a href="{{ route('admin.products.create') }}" class="text-amber-500 hover:underline">Create one</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
