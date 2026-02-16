<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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
                    <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Admin Panel</h1>
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
                @yield('content')
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
