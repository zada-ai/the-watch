<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex flex-col lg:flex-row h-screen">
        <!-- Mobile Menu Toggle -->
        <div class="lg:hidden bg-gray-900 text-white p-4 flex items-center justify-between">
            <h2 class="text-xl font-bold">Admin Panel</h2>
            <button id="menuToggle" class="text-2xl focus:outline-none">☰</button>
        </div>

        <!-- Sidebar -->
        <div id="sidebar" class="hidden lg:flex w-full lg:w-64 bg-gray-900 text-white p-6 flex flex-col absolute lg:relative top-16 lg:top-0 left-0 right-0 shadow-lg lg:shadow-none">
            <h2 class="text-2xl font-bold mb-8 hidden lg:block">Admin Panel</h2>
            <nav class="flex-1 space-y-2 lg:space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm lg:text-base rounded bg-amber-500 hover:bg-amber-600">
                    📊 Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 text-sm lg:text-base rounded hover:bg-gray-700">
                    📦 Products
                </a>
                <a href="{{ route('admin.bestseller.index') }}" class="block px-4 py-2 text-sm lg:text-base rounded hover:bg-gray-700">
                    ⭐ Best Sellers
                </a>
                <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 text-sm lg:text-base rounded hover:bg-gray-700">
                    📋 Order Requests
                </a>
                <a href="{{ route('admin.placed-orders.index') }}" class="block px-4 py-2 text-sm lg:text-base rounded hover:bg-gray-700">
                    🧾 Placed Orders
                </a>
                <a href="{{ route('admin.reviews.index') }}" class="block px-4 py-2 text-sm lg:text-base rounded hover:bg-gray-700">
                    💬 Customer Reviews
                </a>
                <a href="{{ route('admin.headphones.index') }}" class="block px-4 py-2 text-sm lg:text-base rounded hover:bg-gray-700">
                    🎧 Headphones
                </a>
                <a href="{{ route('admin.watchespage.index') }}" class="block px-4 py-2 text-sm lg:text-base rounded hover:bg-gray-700">
                    ⌚ WatchesPage
                </a>
                <a href="{{ route('admin.airbuds.index') }}" class="block px-4 py-2 text-sm lg:text-base rounded hover:bg-gray-700">
                    🎧 Airbuds
                </a>
                <a href="{{ route('admin.perfume.index') }}" class="block px-4 py-2 text-sm lg:text-base rounded hover:bg-gray-700">
                    🌸 Perfume
                </a>
                <a href="{{ route('admin.wallets.index') }}" class="block px-4 py-2 text-sm lg:text-base rounded hover:bg-gray-700">
                    👝 Wallets
                </a>
                <a href="{{ route('admin.toys.index') }}" class="block px-4 py-2 text-sm lg:text-base rounded hover:bg-gray-700">
                    🧸 Toys
                </a>
                
            </nav>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full px-4 py-2 text-sm lg:text-base rounded bg-red-600 hover:bg-red-700">
                    🚪 Logout
                </button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto w-full">
            <div class="bg-white shadow-md p-4 lg:p-6 border-b border-gray-200 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Welcome to Admin Dashboard</h1>
                    <p class="text-sm lg:text-base text-gray-600">Manage your store and products</p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.buy-images.index') }}" class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded shadow">
                        📷 Upload Buy Images
                    </a>
                    <a href="{{ route('admin.buy-videos.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded shadow">
                        🎬 Upload Buy Video
                    </a>
                    <a href="{{ route('admin.reviews.index') }}" class="inline-flex items-center px-4 py-2 bg-pink-500 hover:bg-pink-600 text-white rounded shadow">
                        💬 Manage Reviews
                    </a>
                </div>
            </div>

            <div class="p-4 lg:p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-4 lg:p-6">
                        <div class="flex flex-col lg:flex-row items-center lg:items-start justify-between gap-2 lg:gap-4">
                            <div>
                                <p class="text-gray-600 text-xs lg:text-sm">Total Products</p>
                                <p class="text-2xl lg:text-3xl font-bold text-gray-800">{{ \App\Models\Product::count() }}</p>
                            </div>
                            <span class="text-3xl lg:text-4xl">📦</span>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-4 lg:p-6">
                        <div class="flex flex-col lg:flex-row items-center lg:items-start justify-between gap-2 lg:gap-4">
                            <div>
                                <p class="text-gray-600 text-xs lg:text-sm">Watches</p>
                                <p class="text-2xl lg:text-3xl font-bold text-blue-600">{{ \App\Models\Product::where('category', 'watches')->count() }}</p>
                            </div>
                            <span class="text-3xl lg:text-4xl">⌚</span>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-4 lg:p-6">
                        <div class="flex flex-col lg:flex-row items-center lg:items-start justify-between gap-2 lg:gap-4">
                            <div>
                                <p class="text-gray-600 text-xs lg:text-sm">Order Requests</p>
                                <p class="text-2xl lg:text-3xl font-bold text-green-600">{{ \App\Models\OrderRequest::count() }}</p>
                            </div>
                            <span class="text-3xl lg:text-4xl">📮</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow p-4 lg:p-6">
                    <h2 class="text-lg lg:text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-2 lg:gap-4">
                        <a href="{{ route('admin.products.create') }}" class="block p-3 lg:p-4 bg-amber-50 border border-amber-200 rounded-lg hover:bg-amber-100 transition">
                            <p class="font-semibold text-xs lg:text-base text-amber-900">➕ Add New Product</p>
                            <p class="text-xs text-amber-700">Create a new product listing</p>
                        </a>
                        <a href="{{ route('admin.bestseller.create') }}" class="block p-3 lg:p-4 bg-purple-50 border border-purple-200 rounded-lg hover:bg-purple-100 transition">
                            <p class="font-semibold text-xs lg:text-base text-purple-900">⭐ Add Best Seller</p>
                            <p class="text-xs text-purple-700">Create featured product</p>
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="block p-3 lg:p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
                            <p class="font-semibold text-xs lg:text-base text-blue-900">📋 View All Products</p>
                            <p class="text-xs text-blue-700">Manage existing products</p>
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="block p-3 lg:p-4 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition">
                            <p class="font-semibold text-xs lg:text-base text-green-900">📮 View Orders</p>
                            <p class="text-xs text-green-700">See customer contacts</p>
                        </a>
                        <a href="{{ route('admin.placed-orders.index') }}" class="block p-3 lg:p-4 bg-yellow-50 border border-yellow-200 rounded-lg hover:bg-yellow-100 transition">
                            <p class="font-semibold text-xs lg:text-base text-yellow-900">🧾 Placed Orders</p>
                            <p class="text-xs text-yellow-700">View placed orders with details</p>
                        </a>
                        <a href="{{ route('admin.reviews.index') }}" class="block p-3 lg:p-4 bg-pink-50 border border-pink-200 rounded-lg hover:bg-pink-100 transition">
                            <p class="font-semibold text-xs lg:text-base text-pink-900">💬 Manage Reviews</p>
                            <p class="text-xs text-pink-700">Manage customer reviews</p>
                        </a>
                        <a href="{{ route('admin.headphones.create') }}" class="block p-3 lg:p-4 bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-100 transition">
                            <p class="font-semibold text-xs lg:text-base text-indigo-900">🎧 Add Headphone</p>
                            <p class="text-xs text-indigo-700">Create a new headphone entry</p>
                        </a>
                        <a href="{{ route('admin.watchespage.create') }}" class="block p-3 lg:p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
                            <p class="font-semibold text-xs lg:text-base text-blue-900">⌚ Add WatchesPage</p>
                            <p class="text-xs text-blue-700">Create a new watches entry</p>
                        </a>
                        <a href="{{ route('admin.airbuds.create') }}" class="block p-3 lg:p-4 bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-100 transition">
                            <p class="font-semibold text-xs lg:text-base text-indigo-900">🎧 Add Airbud</p>
                            <p class="text-xs text-indigo-700">Create a new airbud entry</p>
                        </a>
                        <a href="{{ route('admin.perfume.create') }}" class="block p-3 lg:p-4 bg-pink-50 border border-pink-200 rounded-lg hover:bg-pink-100 transition">
                            <p class="font-semibold text-xs lg:text-base text-pink-900">🌸 Add Perfume</p>
                            <p class="text-xs text-pink-700">Create a new perfume entry</p>
                        </a>
                        <a href="{{ route('admin.wallets.create') }}" class="block p-3 lg:p-4 bg-yellow-50 border border-yellow-200 rounded-lg hover:bg-yellow-100 transition">
                            <p class="font-semibold text-xs lg:text-base text-yellow-900">👝 Add Wallet</p>
                            <p class="text-xs text-yellow-700">Create a new wallet entry</p>
                        </a>
                        <a href="{{ route('admin.toys.create') }}" class="block p-3 lg:p-4 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition">
                            <p class="font-semibold text-xs lg:text-base text-green-900">🧸 Add Toy</p>
                            <p class="text-xs text-green-700">Create a new toy entry</p>
                        </a>
                    </div>
                </div>

                <!-- Recent Products -->
                <div class="bg-white rounded-lg shadow p-4 lg:p-6 mt-6">
                    <h2 class="text-lg lg:text-xl font-bold text-gray-800 mb-4">Recent Products</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-xs lg:text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-2 lg:px-4 py-2 text-left">Name</th>
                                    <th class="px-2 lg:px-4 py-2 text-left hidden sm:table-cell">Category</th>
                                    <th class="px-2 lg:px-4 py-2 text-left hidden md:table-cell">Price</th>
                                    <th class="px-2 lg:px-4 py-2 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(\App\Models\Product::latest()->limit(5)->get() as $product)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-2 lg:px-4 py-2">{{ $product->name }}</td>
                                        <td class="px-2 lg:px-4 py-2 hidden sm:table-cell">
                                            <span class="text-xs px-2 py-1 rounded
                                                @if($product->category === 'watches') bg-blue-100 text-blue-800
                                                @elseif($product->category === 'headphones') bg-purple-100 text-purple-800
                                                @else bg-pink-100 text-pink-800
                                                @endif">
                                                {{ ucfirst($product->category) }}
                                            </span>
                                        </td>
                                        <td class="px-2 lg:px-4 py-2 hidden md:table-cell">Rs {{ number_format($product->price) }}</td>
                                        <td class="px-2 lg:px-4 py-2">
                                            @if($product->active)
                                                <span class="text-green-600 text-xs font-semibold">✓ Active</span>
                                            @else
                                                <span class="text-red-600 text-xs font-semibold">✗ Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-2 lg:px-4 py-6 text-center text-gray-500">
                                            No products yet. <a href="{{ route('admin.products.create') }}" class="text-amber-500 hover:underline">Create one</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('menuToggle')?.addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('flex');
        });

        // Close menu when a link is clicked on mobile
        document.querySelectorAll('#sidebar a, #sidebar button').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 1024) {
                    document.getElementById('sidebar').classList.add('hidden');
                    document.getElementById('sidebar').classList.remove('flex');
                }
            });
        });

        // Close menu when window is resized to desktop size
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                document.getElementById('sidebar').classList.remove('hidden');
                document.getElementById('sidebar').classList.add('flex');
            }
        });
    </script>
</body>
</html>
