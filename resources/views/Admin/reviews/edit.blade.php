<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review - Admin Dashboard</title>
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
                <a href="{{ route('admin.reviews.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
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
                <h1 class="text-3xl font-bold text-gray-800">✏️ Edit Review</h1>
                <p class="text-gray-600">Update customer review</p>
            </div>

            <div class="p-6">
                <div class="max-w-2xl">
                    <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Customer Name *</label>
                            <input type="text" name="name" placeholder="Enter customer name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 @error('name') border-red-500 @enderror" value="{{ old('name', $review->name) }}" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Product Name -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Product Name</label>
                            <input type="text" name="product_name" placeholder="Enter product name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" value="{{ old('product_name', $review->product_name) }}">
                            @error('product_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Product Type & ID -->
                        <div class="mb-6 grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Product Type</label>
                                <select name="product_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                                    <option value="">-- Select --</option>
                                    <option value="Product" @if(old('product_type', $review->product_type) == 'Product') selected @endif>Product</option>
                                    <option value="BestSeller" @if(old('product_type', $review->product_type) == 'BestSeller') selected @endif>BestSeller</option>
                                    <option value="WatchesPage" @if(old('product_type', $review->product_type) == 'WatchesPage') selected @endif>WatchesPage</option>
                                    <option value="WalletsProduct" @if(old('product_type', $review->product_type) == 'WalletsProduct') selected @endif>WalletsProduct</option>
                                    <option value="AirbudsProduct" @if(old('product_type', $review->product_type) == 'AirbudsProduct') selected @endif>AirbudsProduct</option>
                                    <option value="PerfumeProduct" @if(old('product_type', $review->product_type) == 'PerfumeProduct') selected @endif>PerfumeProduct</option>
                                    <option value="HeadphonesProduct" @if(old('product_type', $review->product_type) == 'HeadphonesProduct') selected @endif>HeadphonesProduct</option>
                                    <option value="ToysProduct" @if(old('product_type', $review->product_type) == 'ToysProduct') selected @endif>ToysProduct</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Product ID</label>
                                <input type="text" name="product_id" placeholder="Enter product id" class="w-full px-4 py-2 border border-gray-300 rounded-lg" value="{{ old('product_id', $review->product_id) }}">
                            </div>
                        </div>

                        <!-- Rating -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Rating *</label>
                            <div class="flex gap-2 text-3xl">
                                @for($i = 1; $i <= 5; $i++)
                                    <input type="radio" name="rating" id="rating{{ $i }}" value="{{ $i }}" class="hidden" @if(old('rating', $review->rating) == $i) checked @endif>
                                    <label for="rating{{ $i }}" class="cursor-pointer text-gray-400 hover:text-amber-500" style="color: {{ $i <= $review->rating ? '#f59e0b' : '#d1d5db' }}">★</label>
                                @endfor
                            </div>
                            @error('rating')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Review -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Review *</label>
                            <textarea name="review" rows="5" placeholder="Write the review..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 @error('review') border-red-500 @enderror" required>{{ old('review', $review->review) }}</textarea>
                            @error('review')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Image -->
                        @if($review->image)
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Current Image</label>
                                <img src="{{ asset('storage/' . $review->image) }}" alt="Review Image" class="w-40 h-40 rounded object-cover">
                            </div>
                        @endif

                        <!-- Image -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Change Image (Optional)</label>
                            <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                            <p class="text-gray-500 text-sm mt-1">Max size: 2MB</p>
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4">
                            <button type="submit" class="px-6 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600">
                                ✅ Update Review
                            </button>
                            <a href="{{ route('admin.reviews.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                                ❌ Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Star rating system
        const stars = document.querySelectorAll('label[for^="rating"]');
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('for').replace('rating', '');
                document.getElementById('rating' + value).checked = true;
                updateStars(value);
            });

            star.addEventListener('mouseover', function() {
                const value = this.getAttribute('for').replace('rating', '');
                highlightStars(value);
            });
        });

        document.querySelector('[name="rating"]')?.parentElement.addEventListener('mouseleave', function() {
            const checkedValue = document.querySelector('[name="rating"]:checked')?.value || 0;
            updateStars(checkedValue);
        });

        function highlightStars(count) {
            const stars = document.querySelectorAll('label[for^="rating"]');
            stars.forEach((star, index) => {
                star.style.color = index < count ? '#f59e0b' : '#d1d5db';
            });
        }

        function updateStars(count) {
            highlightStars(count);
        }
    </script>
</body>
</html>
