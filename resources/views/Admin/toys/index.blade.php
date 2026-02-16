<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toys Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <div class="w-64 bg-gray-900 text-white p-6 flex flex-col">
            <h2 class="text-2xl font-bold mb-8">Admin Panel</h2>
            <nav class="flex-1 space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">📊 Dashboard</a>
                <a href="{{ route('admin.toys.create') }}" class="block px-4 py-2 rounded">+ Add Toy</a>
            </nav>
            <form action="{{ route('admin.logout') }}" method="POST">@csrf<button type="submit" class="w-full px-4 py-2 rounded bg-red-600 hover:bg-red-700">🚪 Logout</button></form>
        </div>

        <div class="flex-1 overflow-auto">
            <div class="bg-white shadow-md p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800">Toys</h1>
            </div>

            <div class="p-6">
                <div class="mb-4">
                    <form method="GET" action="{{ route('admin.toys.index') }}" class="flex gap-2">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search..." class="border rounded px-3 py-2 w-full">
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded">Search</button>
                    </form>
                </div>

                <table class="min-w-full bg-white border">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Name</th>
                            <th class="px-4 py-2 border">Price</th>
                            <th class="px-4 py-2 border">Active</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $it)
                            <tr>
                                <td class="px-4 py-2 border">{{ $it->id }}</td>
                                <td class="px-4 py-2 border">{{ $it->name }}</td>
                                <td class="px-4 py-2 border">{{ $it->price }}</td>
                                <td class="px-4 py-2 border">{{ $it->active ? 'Yes' : 'No' }}</td>
                                <td class="px-4 py-2 border">
                                    <a href="{{ route('admin.toys.edit', $it->id) }}" class="text-indigo-600">Edit</a>
                                    <form action="{{ route('admin.toys.destroy', $it->id) }}" method="POST" style="display:inline">@csrf @method('DELETE')<button class="text-red-600 ml-2">Delete</button></form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $items->links() }}
                </div>
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
    <title>Toys - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <div class="w-64 bg-gray-900 text-white p-6 flex flex-col">
            <h2 class="text-2xl font-bold mb-8">Admin Panel</h2>
            <nav class="flex-1 space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">📊 Dashboard</a>
                <a href="{{ route('admin.toys.index') }}" class="block px-4 py-2 rounded bg-indigo-500 hover:bg-indigo-600">🧸 Toys</a>
            </nav>
            <form action="{{ route('admin.logout') }}" method="POST">@csrf<button type="submit" class="w-full px-4 py-2 rounded bg-red-600 hover:bg-red-700">🚪 Logout</button></form>
        </div>

        <div class="flex-1 overflow-auto">
            <div class="bg-white shadow-md p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800">Toys Entries</h1>
            </div>

            <div class="p-6">
                @if(session('success'))<div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">✓ {{ session('success') }}</div>@endif

                <div class="mb-6"><a href="{{ route('admin.toys.create') }}" class="inline-block px-6 py-3 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold rounded-lg">➕ Add New</a></div>

                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold">ID</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Price</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                                <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $item->id }}</td>
                                    <td class="px-6 py-4">{{ $item->name }}</td>
                                    <td class="px-6 py-4">Rs {{ number_format($item->price ?? 0) }}</td>
                                    <td class="px-6 py-4">@if($item->active)<span class="text-green-600 font-semibold">✓ Active</span>@else<span class="text-red-600 font-semibold">✗ Inactive</span>@endif</td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                        <a href="{{ route('admin.toys.edit', $item->id) }}" class="inline-block px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded text-sm">Edit</a>
                                        <form action="{{ route('admin.toys.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">@csrf @method('DELETE')<button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-sm">Delete</button></form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">No entries yet. <a href="{{ route('admin.toys.create') }}" class="text-indigo-500 hover:underline">Create one</a></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($items->hasPages())<div class="mt-6">{{ $items->links() }}</div>@endif
            </div>
        </div>
    </div>
</body>
</html>
