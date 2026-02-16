<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-white p-6 flex flex-col">
            <h2 class="text-2xl font-bold mb-8">Admin Panel</h2>
            <nav class="flex-1 space-y-4">
                <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
                    📦 Products
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
                <h1 class="text-3xl font-bold text-gray-800">Edit Product: {{ $product->name }}</h1>
            </div>

            <div class="p-6">
                <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-4">
                            <label class="block text-sm font-semibold mb-2">Product Name *</label>
                            <input type="text" name="name" required value="{{ old('name', $product->name) }}" 
                                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('name') border-red-500 @enderror">
                            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-4">
                            <label class="block text-sm font-semibold mb-2">Category *</label>
                            <select name="category" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('category') border-red-500 @enderror">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                                @endforeach
                            </select>
                            @error('category') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <!-- Price -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-semibold mb-2">Price *</label>
                                <input type="number" name="price" required value="{{ old('price', $product->price) }}" 
                                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('price') border-red-500 @enderror">
                                @error('price') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-2">Original Price</label>
                                <input type="number" name="original_price" value="{{ old('original_price', $product->original_price) }}" 
                                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-500">
                            </div>
                        </div>

                        <!-- Discount -->
                        <div class="mb-4">
                            <label class="block text-sm font-semibold mb-2">Discount (%)</label>
                            <input type="number" name="discount" min="0" max="100" value="{{ old('discount', $product->discount) }}" 
                                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-500">
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label class="block text-sm font-semibold mb-2">Description</label>
                            <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-500">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <!-- Colors (comma-separated) -->
                        <div class="mb-4">
                            <label class="block text-sm font-semibold mb-2">Colors (comma-separated hex codes)</label>
                            <input type="text" name="colors" value="{{ old('colors', implode(', ', $product->colors ?? [])) }}" 
                                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-500">
                            <p class="text-xs text-gray-500 mt-1">Example: #111827, #b45309, #0369a1</p>
                        </div>

                        <!-- Images (comma-separated paths) -->
                        <div class="mb-4">
                            <label class="block text-sm font-semibold mb-2">Images (comma-separated paths)</label>
                            <textarea name="images" rows="3" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-500">{{ old('images', implode(', ', $product->images ?? [])) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Example: Landingpaginationimg/desktop_9.jfif, Landingpaginationimg/desktop_4.jfif</p>
                        </div>

                        <!-- Active -->
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="active" value="1" {{ old('active', $product->active) ? 'checked' : '' }} class="mr-2">
                                <span class="text-sm font-semibold">Active Product</span>
                            </label>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3">
                            <button type="submit" class="px-6 py-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold rounded">
                                ✓ Update Product
                            </button>
                            <a href="{{ route('admin.products.index') }}" class="px-6 py-2 bg-gray-400 hover:bg-gray-500 text-white font-semibold rounded">
                                ✕ Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
