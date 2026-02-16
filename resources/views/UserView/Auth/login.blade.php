<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Shirti Penti</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-3xl shadow-2xl flex max-w-4xl w-full overflow-hidden">
        <!-- Left image side -->
        <div class="w-1/2 bg-cover bg-center hidden md:block" style="background-image: url('https://images.unsplash.com/photo-1593032465176-bcf7aa74f4f5?auto=format&fit=crop&w=800&q=80');">
        </div>

        <!-- Right form side -->
        <div class="w-full md:w-1/2 p-10">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Welcome Back!</h2>
            <p class="text-gray-500 mb-8">Login to access your account and explore exclusive shirts, pants & shoes!</p>

            <!-- Login Form -->
            <form id="loginForm" class="space-y-6" method="POST" action="{{ url('/api/login') }}">
                @csrf
                <div>
                    <label for="email" class="block text-gray-700 font-semibold">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                </div>
                <div>
                    <label for="password" class="block text-gray-700 font-semibold">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                </div>
                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-semibold transition duration-300">Login</button>
            </form>

            <p class="text-gray-500 mt-6 text-center">Don't have an account? <a href="{{ route('register.view') }}" class="text-purple-600 font-semibold">Register</a></p>
        </div>
    </div>

    <!-- Optional JS for AJAX login -->
    <script>
        const loginForm = document.getElementById('loginForm');
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(loginForm);
            const data = Object.fromEntries(formData.entries());

            try {
                const res = await fetch('{{ url("/api/login") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify(data)
                });

                const response = await res.json();

                if(response.status){
                    alert('Login Successful! Token: ' + response.access_token);
                    localStorage.setItem('auth_token', response.access_token);
                    window.location.href = '{{ route("user.home") }}'; // redirect to user homepage
                } else {
                    alert(response.message);
                }
            } catch(err){
                alert('Error: ' + err.message);
            }
        });
    </script>

</body>
</html>
