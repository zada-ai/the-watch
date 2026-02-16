<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Buy Images</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style> img { max-width:180px; display:block; }</style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar (simplified) -->
        <div class="w-64 bg-gray-900 text-white p-6 flex flex-col">
            <h2 class="text-2xl font-bold mb-8">Admin Panel</h2>
            <nav class="flex-1 space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">📊 Dashboard</a>
                <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">📦 Products</a>
                <a href="{{ route('admin.buy-images.index') }}" class="block px-4 py-2 rounded bg-amber-500 hover:bg-amber-600">📷 Buy Images</a>
            </nav>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full px-4 py-2 rounded bg-red-600 hover:bg-red-700">🚪 Logout</button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="bg-white shadow-md p-6 border-b border-gray-200">
                <h1 class="text-2xl font-bold">Upload Buy-Only Images</h1>
            </div>

            <div class="p-6">
                @if(session('status'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">{{ session('status') }}</div>
                @endif

                <form action="{{ route('admin.buy-images.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
                    @csrf
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm text-gray-700">Product Type</label>
                            <select name="product" id="product_type" required class="mt-1 w-full border rounded px-3 py-2">
                                <option value="">-- Select Type --</option>
                                <option value="Product">📦 Product</option>
                                <option value="BestSeller">⭐ Best Seller</option>
                                <option value="WatchesPage">⌚ Watches</option>
                                <option value="WalletsProduct">👝 Wallets</option>
                                <option value="AirbudsProduct">🎧 Airbuds</option>
                                <option value="PerfumeProduct">🌸 Perfume</option>
                                <option value="HeadphonesProduct">🎧 Headphones</option>
                                <option value="ToysProduct">🧸 Toys</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm text-gray-700">Product / Card ID</label>
                            <input type="text" name="product_id" id="product_id" required class="mt-1 w-full border rounded px-3 py-2" />
                        </div>

                        <div>
                            <label class="block text-sm text-gray-700">Images (multiple)</label>
                            <input type="file" name="buy_images[]" id="buy_images" multiple accept="image/*" required class="mt-1" />
                        </div>

                        <div>
                            <button type="submit" class="px-4 py-2 bg-amber-500 text-white rounded">Upload</button>
                        </div>
                    </div>
                </form>

                <hr class="my-6" />

                <h2 class="text-lg font-semibold mb-2">Preview / Manage</h2>
                <p class="text-sm text-gray-600 mb-4">Enter product type and product id above then click <strong>Preview Images</strong>.</p>

                <div class="mb-4">
                    <button id="previewBtn" class="px-3 py-2 bg-blue-500 text-white rounded">Preview Images</button>
                </div>

                <div id="previewArea" class="grid grid-cols-2 md:grid-cols-3 gap-4"></div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('previewBtn').addEventListener('click', function(){
        var type = document.getElementById('product_type').value;
        var id = document.getElementById('product_id').value;
        if(!type || !id){ alert('Select type and enter product id'); return; }

        fetch('{{ route('admin.buy-images.list') }}?product_type=' + encodeURIComponent(type) + '&product_id=' + encodeURIComponent(id), {
            headers: { 'Accept': 'application/json' },
            credentials: 'same-origin'
        }).then(r => r.json()).then(data => {
            var area = document.getElementById('previewArea');
            area.innerHTML = '';
            if(!data || data.length === 0){ area.innerText = 'No images'; return; }
            data.forEach(function(img){
                var card = document.createElement('div');
                card.className = 'bg-white p-3 rounded shadow';
                var image = document.createElement('img');
                image.src = img.image_path;
                card.appendChild(image);

                var btns = document.createElement('div');
                btns.style.marginTop = '8px';

                var del = document.createElement('button');
                del.innerText = 'Delete';
                del.className = 'px-3 py-1 bg-red-500 text-white rounded';
                del.addEventListener('click', function(){
                    if(!confirm('Delete this image?')) return;
                    fetch('{{ url('/admin/buy-images') }}/' + img.id, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    }).then(r => r.json()).then(resp => { if(resp.deleted){ card.remove(); } else { alert('Delete failed'); } });
                });
                btns.appendChild(del);

                card.appendChild(btns);
                area.appendChild(card);
            });
        }).catch(err => alert('Failed to fetch images'));
    });
    </script>
</body>
</html>
