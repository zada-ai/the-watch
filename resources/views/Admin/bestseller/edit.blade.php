<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Best Seller</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-white p-6 flex flex-col">
            <h2 class="text-2xl font-bold mb-8">Admin Panel</h2>
            <nav class="space-y-4 flex-1">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-800">Dashboard</a>
                <a href="{{ route('admin.bestseller.index') }}" class="block px-4 py-2 rounded bg-gray-800">Best Sellers</a>
                <a href="{{ route('admin.bestseller.create') }}" class="block px-4 py-2 rounded hover:bg-gray-800">Add New</a>
            </nav>
            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded">Logout</button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="bg-white shadow p-6 mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Edit Best Seller</h1>
            </div>
            <div class="container mx-auto px-4 py-6">

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.bestseller.update', $bestseller) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg p-6 max-w-2xl">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Product Name *</label>
                            <input type="text" name="name" value="{{ old('name', $bestseller->name) }}" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500" required>
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Category *</label>
                            <select name="category" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('category', $bestseller->category) == $cat ? 'selected' : '' }}>
                                        {{ ucfirst($cat) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Original Price -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Original Price (Rs) *</label>
                            <input type="number" name="orig_price" value="{{ old('orig_price', $bestseller->orig_price) }}" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500" step="0.01" required>
                        </div>

                        <!-- Sale Price -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Sale Price (Rs) *</label>
                            <input type="number" name="sale_price" value="{{ old('sale_price', $bestseller->sale_price) }}" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500" step="0.01" required>
                        </div>

                        <!-- Discount -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Discount (%) *</label>
                            <input type="number" name="discount" value="{{ old('discount', $bestseller->discount) }}" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500" min="0" max="100" required>
                        </div>

                        <!-- Active Status -->
                        <div class="flex items-center">
                            <label class="block text-gray-700 font-semibold mb-2">Active Status</label>
                            <input type="checkbox" name="active" value="1" class="ml-4 mt-1" {{ $bestseller->active ? 'checked' : '' }}>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <label class="block text-gray-700 font-semibold mb-2">Description *</label>
                        <textarea name="descri" rows="4" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500" required>{{ old('descri', $bestseller->descri) }}</textarea>
                    </div>

                    <!-- Colors & Images -->
                    <div class="mt-6 border-t pt-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Colors & Images</h3>
                        <div id="colors-container">
                            @forelse($bestseller->colors ?? [] as $colorName => $colorCode)
                                <div class="color-row bg-gray-50 rounded p-4 mb-4 border border-gray-200">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-gray-700 font-semibold mb-2">Color Name</label>
                                            <input type="text" name="colors[]" value="{{ $colorName }}" placeholder="e.g., red, blue" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 font-semibold mb-2">Hex Code</label>
                                            <div class="flex gap-2">
                                                <input type="color" name="color_codes[]" value="{{ $colorCode }}" class="border border-gray-300 rounded px-3 py-2 w-16 h-10" required>
                                                <button type="button" onclick="removeColor(this)" class="bg-red-500 hover:bg-red-600 text-white px-4 rounded">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Current images for this color -->
                                    @if(!empty($bestseller->images[$colorName]))
                                        <div class="mb-4">
                                            <label class="block text-gray-700 font-semibold mb-2 text-sm">Current Images</label>
                                            <div class="grid grid-cols-2 md:grid-cols-3 gap-2 mb-3">
                                                @foreach($bestseller->images[$colorName] as $image)
                                                    <img src="{{ $image }}" alt="{{ $colorName }}" class="w-full h-20 object-cover rounded border border-gray-300">
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div>
                                        <label class="block text-gray-700 font-semibold mb-2">Update Images for {{ ucfirst($colorName) }}</label>
                                        <input type="file" name="images_color_{{ $loop->index }}[]" multiple accept="image/*" class="w-full border border-gray-300 rounded px-4 py-2">
                                        <small class="text-gray-500">Leave empty to keep current images</small>
                                    </div>
                                </div>
                            @empty
                                <div class="color-row bg-gray-50 rounded p-4 mb-4 border border-gray-200">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-gray-700 font-semibold mb-2">Color Name</label>
                                            <input type="text" name="colors[]" placeholder="e.g., red, blue" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 font-semibold mb-2">Hex Code</label>
                                            <div class="flex gap-2">
                                                <input type="color" name="color_codes[]" value="#ff0000" class="border border-gray-300 rounded px-3 py-2 w-16 h-10" required>
                                                <button type="button" onclick="removeColor(this)" class="bg-red-500 hover:bg-red-600 text-white px-4 rounded">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-semibold mb-2">Images for this Color</label>
                                        <input type="file" name="images_color_0[]" multiple accept="image/*" class="w-full border border-gray-300 rounded px-4 py-2">
                                        <small class="text-gray-500">Upload 2-5 images for this color</small>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <button type="button" onclick="addColor()" class="mt-3 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded font-semibold">+ Add Another Color</button>
                    </div>

                    <!-- Submit -->
                    <div class="mt-8 flex gap-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-3 px-8 rounded-lg font-semibold transition">
                            Update Best Seller
                        </button>
                        <a href="{{ route('admin.bestseller.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-3 px-8 rounded-lg font-semibold transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<script>
let colorIndex = {{ count($bestseller->colors ?? []) }};

function addColor() {
    const container = document.getElementById('colors-container');
    const colorRow = document.createElement('div');
    colorRow.className = 'color-row bg-gray-50 rounded p-4 mb-4 border border-gray-200';
    colorRow.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Color Name</label>
                <input type="text" name="colors[]" placeholder="e.g., blue, green" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Hex Code</label>
                <div class="flex gap-2">
                    <input type="color" name="color_codes[]" value="#0000ff" class="border border-gray-300 rounded px-3 py-2 w-16 h-10" required>
                    <button type="button" onclick="removeColor(this)" class="bg-red-500 hover:bg-red-600 text-white px-4 rounded">Remove</button>
                </div>
            </div>
        </div>
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Images for this Color</label>
            <input type="file" name="images_color_${colorIndex}[]" multiple accept="image/*" class="w-full border border-gray-300 rounded px-4 py-2">
            <small class="text-gray-500">Upload 2-5 images for this color</small>
        </div>
    `;
    container.appendChild(colorRow);
    colorIndex++;
}

function removeColor(btn) {
    btn.closest('.color-row').remove();
}
</script>
</html>
