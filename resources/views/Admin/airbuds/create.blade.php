<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Airbud Entry</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <div class="w-64 bg-gray-900 text-white p-6 flex flex-col">
            <h2 class="text-2xl font-bold mb-8">Admin Panel</h2>
            <nav class="flex-1 space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">📊 Dashboard</a>
                <a href="{{ route('admin.airbuds.index') }}" class="block px-4 py-2 rounded">🎧 Airbuds</a>
            </nav>
            <form action="{{ route('admin.logout') }}" method="POST">@csrf<button type="submit" class="w-full px-4 py-2 rounded bg-red-600 hover:bg-red-700">🚪 Logout</button></form>
        </div>

        <div class="flex-1 overflow-auto">
            <div class="bg-white shadow-md p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800">Create Airbud Entry</h1>
            </div>

            <div class="p-6">
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <p class="font-semibold">Please fix the errors below.</p>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.airbuds.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" name="price" value="{{ old('price') }}" class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Original Price</label>
                            <input type="number" name="orig_price" value="{{ old('orig_price') }}" class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Discount (%)</label>
                            <input type="number" name="discount" value="{{ old('discount') }}" class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="descri" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('descri') }}</textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Images (upload files or paste comma-separated paths)</label>
                            <input type="file" name="image_files[]" multiple accept="image/*" class="mt-1 block w-full">
                            <input type="text" name="images_text" value='{{ old('images_text') }}' placeholder="optional: path1.jpg, path2.jpg" class="mt-2 block w-full border-gray-300 rounded-md">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Colors (JSON object or comma-separated key:value pairs)</label>
                            <input type="text" name="colors" value='{{ old('colors') }}' placeholder="e.g. white:#ffffff, black:#000000" class="mt-1 block w-full border-gray-300 rounded-md">
                            <p class="text-xs text-gray-500 mt-1">Example: <code>white:#ffffff, black:#000000</code> or <code>{"white":"#ffffff"}</code></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Gender</label>
                            <select name="gender" class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="men">Men</option>
                                <option value="women">Women</option>
                                <option value="unisex">Unisex</option>
                            </select>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="active" id="active" class="h-4 w-4 text-indigo-600">
                            <label for="active" class="text-sm">Active</label>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded">Create</button>
                        <a href="{{ route('admin.airbuds.index') }}" class="ml-4 text-gray-600">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Airbud Entry</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <div class="w-64 bg-gray-900 text-white p-6 flex flex-col">
            <h2 class="text-2xl font-bold mb-8">Admin Panel</h2>
            <nav class="flex-1 space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">📊 Dashboard</a>
                <a href="{{ route('admin.airbuds.index') }}" class="block px-4 py-2 rounded">🎧 Airbuds</a>
            </nav>
            <form action="{{ route('admin.logout') }}" method="POST">@csrf<button type="submit" class="w-full px-4 py-2 rounded bg-red-600 hover:bg-red-700">🚪 Logout</button></form>
        </div>

        <div class="flex-1 overflow-auto">
            <div class="bg-white shadow-md p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800">Add Airbud Entry</h1>
            </div>

            <div class="p-6">
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <p class="font-semibold">Please fix the errors below.</p>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.airbuds.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" name="price" value="{{ old('price') }}" class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Original Price</label>
                            <input type="number" name="orig_price" value="{{ old('orig_price') }}" class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Discount (%)</label>
                            <input type="number" name="discount" value="{{ old('discount') }}" class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="descri" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('descri') }}</textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Images (upload files or paste comma-separated paths)</label>
                            <input type="file" name="image_files[]" multiple accept="image/*" class="mt-1 block w-full">
                            <input type="text" name="images_text" value='{{ old('images_text') }}' placeholder="optional: path1.jpg, path2.jpg" class="mt-2 block w-full border-gray-300 rounded-md">
                            <p class="text-xs text-gray-500 mt-1">Uploaded files are saved to <strong>storage/airbuds</strong>. You can also paste existing paths (comma-separated) or JSON array.</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Colors (JSON or comma-separated key:value pairs)</label>
                            <input type="text" name="colors" value='{{ old('colors') }}' placeholder="e.g. black:#000000, silver:#c0c0c0" class="mt-1 block w-full border-gray-300 rounded-md">
                            <p class="text-xs text-gray-500 mt-1">Example: <code>black:#000000, silver:#c0c0c0</code> or <code>{"black":"#000000"}</code></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Gender</label>
                            <select name="gender" class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="men">Men</option>
                                <option value="women">Women</option>
                                <option value="unisex">Unisex</option>
                            </select>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="active" id="active" class="h-4 w-4 text-indigo-600">
                            <label for="active" class="text-sm">Active</label>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded">Create</button>
                        <a href="{{ route('admin.airbuds.index') }}" class="ml-4 text-gray-600">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
