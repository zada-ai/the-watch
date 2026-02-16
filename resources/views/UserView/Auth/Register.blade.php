<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Shirt & Shoe Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-lg p-10 w-full max-w-md">
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">Create Your Account</h1>

        <form id="registerForm" class="space-y-4">
            <div>
                <label class="block text-gray-700">Full Name</label>
                <input type="text" name="name" required class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition-all">
                Register
            </button>

            <p class="text-sm text-center text-gray-500 mt-4">
                Already have an account? <a href="/login" class="text-indigo-600 hover:underline">Login here</a>
            </p>
        </form>

        <div id="message" class="mt-4 text-center"></div>
    </div>

    <script>
        const form = document.getElementById('registerForm');
        const messageDiv = document.getElementById('message');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            try {
                const res = await fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(data)
                });

                const json = await res.json();

                if (res.ok) {
                    messageDiv.innerHTML = `<span class="text-green-600 font-semibold">${json.message}</span>`;
                    form.reset();
                } else {
                    messageDiv.innerHTML = `<span class="text-red-600 font-semibold">${json.message}</span>`;
                }

            } catch (err) {
                messageDiv.innerHTML = `<span class="text-red-600 font-semibold">Something went wrong</span>`;
            }
        });
    </script>

</body>
</html>
