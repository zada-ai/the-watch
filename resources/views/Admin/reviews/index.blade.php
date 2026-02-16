<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reviews - Admin Dashboard</title>
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
                <a href="{{ route('admin.bestseller.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
                    ⭐ Best Sellers
                </a>
                <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
                    📋 Order Requests
                </a>
                <a href="{{ route('admin.reviews.index') }}" class="block px-4 py-2 rounded bg-amber-500 hover:bg-amber-600">
                    💬 Customer Reviews
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
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">💬 Customer Reviews</h1>
                        <p class="text-gray-600">Manage all customer reviews</p>
                    </div>
                    <a href="{{ route('admin.reviews.create') }}" class="px-6 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600">
                        ➕ Add New Review
                    </a>
                </div>
            </div>

            <div class="p-6">
                <!-- Product filter / preview (fetch product-specific reviews) -->
                <div class="bg-white rounded-lg shadow p-4 mb-6">
                    <div class="flex gap-3 items-end">
                        <div class="flex-1">
                            <label class="block text-sm text-gray-600">Product Type</label>
                            <select id="filter_product_type" class="mt-1 w-full border rounded px-3 py-2">
                                <option value="">-- Any --</option>
                                <option value="product">Product</option>
                                <option value="bestseller">BestSeller</option>
                                <option value="watches">Watches</option>
                                <option value="wallets">Wallets</option>
                                <option value="airbuds">Airbuds</option>
                                <option value="perfume">Perfume</option>
                                <option value="headphones">Headphones</option>
                                <option value="toys">Toys</option>
                            </select>
                        </div>

                        <div style="width:160px;">
                            <label class="block text-sm text-gray-600">Product ID</label>
                            <input id="filter_product_id" type="text" class="mt-1 w-full border rounded px-3 py-2" placeholder="ID" />
                        </div>

                        <div class="flex-shrink-0">
                            <button id="previewReviewsBtn" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Preview</button>
                            <button id="clearFilterBtn" class="px-3 py-2 ml-2 bg-gray-200 rounded hover:bg-gray-300">Clear</button>
                        </div>
                    </div>
                    <div id="previewMessage" class="text-sm text-gray-500 mt-3"></div>
                </div>
                @if($reviews->count() > 0)
                    <!-- Reviews Table -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Product</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Rating</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Review</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Image</th>
                                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Type / ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $review->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $review->product_name ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-600">{{ $review->product_type ?? '-' }} / {{ $review->product_id ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            <span class="text-amber-500">{{ str_repeat('★', $review->rating) . str_repeat('☆', 5 - $review->rating) }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600 truncate max-w-xs">{{ $review->review }}</td>
                                        <td class="px-6 py-4 text-sm text-center">
                                            @if($review->image)
                                                <img src="{{ asset('storage/' . $review->image) }}" alt="Review Image" class="w-10 h-10 rounded object-cover">
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-center">
                                            <a href="{{ route('admin.reviews.edit', $review->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs">Edit</a>
                                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Are you sure?')" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <script>
                        document.getElementById('previewReviewsBtn')?.addEventListener('click', function(){
                            const type = document.getElementById('filter_product_type').value;
                            const id = document.getElementById('filter_product_id').value.trim();
                            const msg = document.getElementById('previewMessage');
                            if(!type || !id){ msg.textContent = 'Select product type and enter id to preview.'; return; }
                            msg.textContent = 'Loading...';
                            fetch(`{{ route('product.review.list') }}?product_type=${encodeURIComponent(type)}&product_id=${encodeURIComponent(id)}`, { headers: { 'Accept':'application/json' }, credentials: 'same-origin' })
                                .then(r => r.json())
                                .then(data => {
                                    msg.textContent = '';
                                    if(!data || data.length === 0){ msg.textContent = 'No reviews found for this product.'; return; }
                                    // Build a simple table of results and replace current table body
                                    const tbody = document.querySelector('table.w-full tbody');
                                    tbody.innerHTML = '';
                                    data.forEach(function(rv){
                                        const tr = document.createElement('tr');
                                        tr.className = 'border-b border-gray-200 hover:bg-gray-50';
                                        tr.innerHTML = `
                                            <td class="px-6 py-4 text-sm text-gray-900">${rv.name}</td>
                                            <td class="px-6 py-4 text-sm text-gray-600">${rv.product_name || (type + ' #' + id)}</td>
                                            <td class="px-6 py-4 text-sm"><span class="text-amber-500">${'★'.repeat(rv.rating || 0) + '☆'.repeat(5 - (rv.rating || 0))}</span></td>
                                            <td class="px-6 py-4 text-sm text-gray-600 truncate max-w-xs">${rv.review}</td>
                                            <td class="px-6 py-4 text-sm text-center">${rv.image ? `<img src="${'${'}' + (rv.image.startsWith('storage/') ? assetPath(rv.image) : '/storage/' + rv.image) + '}" class="w-10 h-10 rounded object-cover">` : '<span class="text-gray-400">-</span>'}</td>
                                            <td class="px-6 py-4 text-sm text-center"> <a href="/admin/reviews/${rv.id}/edit" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs">Edit</a>
                                                <form action="/admin/reviews/${rv.id}" method="POST" class="inline">@csrf @method('DELETE')<button onclick="return confirm('Are you sure?')" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs">Delete</button></form>
                                            </td>
                                        `;
                                        tbody.appendChild(tr);
                                    });
                                }).catch(err => { msg.textContent = 'Failed to fetch reviews'; });
                        });

                        document.getElementById('clearFilterBtn')?.addEventListener('click', function(){ window.location.reload(); });

                        function assetPath(p){
                            // if already absolute
                            if(p.startsWith('http')) return p;
                            if(p.startsWith('storage/')) return '/'+p;
                            return '/storage/'+p;
                        }
                    </script>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $reviews->links() }}
                    </div>
                @else
                    <div class="bg-white rounded-lg shadow p-12 text-center">
                        <p class="text-gray-600 text-lg">No reviews yet. Start adding reviews!</p>
                        <a href="{{ route('admin.reviews.create') }}" class="mt-4 inline-block px-6 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600">
                            ➕ Add First Review
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
