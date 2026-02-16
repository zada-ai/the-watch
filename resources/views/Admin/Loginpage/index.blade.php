<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black flex items-center justify-center px-4">

    <div class="w-full max-w-4xl bg-white/5 backdrop-blur-xl rounded-2xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
        
        <!-- Left Side (Brand / Info) -->
        <div class="hidden md:flex flex-col justify-center p-10 bg-gradient-to-br from-amber-500 to-orange-600 text-white">
            <h1 class="text-4xl font-extrabold mb-4">Admin Panel</h1>
            <p class="text-lg opacity-90">Secure access to manage products, orders & users.</p>
            <ul class="mt-6 space-y-3 text-sm">
                <li>✔ Product Management</li>
                <li>✔ Orders & Payments</li>
                <li>✔ Users & Roles</li>
            </ul>
        </div>

        <!-- Right Side (Login Form) -->
        <div class="p-8 sm:p-10">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white mb-2">Admin Login</h2>
            <p class="text-gray-400 mb-6">Sign in to continue</p>

   <form action="{{ route('admin.login') }}" method="POST">
    @csrf
    <input type="email" name="email" value="thewatchstore@ru" required>
    <input type="password" name="password" value="Aflatoon11@11" required>
    <button type="submit">Login</button>
</form>


            <p class="text-center text-xs text-gray-500 mt-6">© 2026 Admin Dashboard</p>
        </div>
    </div>

</body>
</html>
