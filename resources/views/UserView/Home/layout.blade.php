<!DOCTYPE html>
<html style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        @keyframes slideInFromRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .page-transition {
            animation: slideInFromRight 0.6s ease-out;
        }


    </style>
</head>
<body class="overflow-x-hidden">
     {{-- Navbar --}}
    @include('UserView.Home.navbar')
{{-- Page Content --}}
    <div class="w-full">
        @yield('content')
    </div>
    {{-- Footer --}}
    @include('UserView.Home.footer')
</body>
<script>
window.addEventListener('load', () => {
    const loader = document.getElementById('watch-loader');
    if (loader) loader.classList.add('hidden');
});

document.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', (e) => {
        try {
            const href = link.getAttribute('href');
            if (!href) return;
            if (href.startsWith('#')) return;
            if (link.hasAttribute('target')) return;
            const loader = document.getElementById('watch-loader');
            if (loader) loader.classList.remove('hidden');
        } catch (err) {
            // ignore
        }
    });
});
</script>
@stack('scripts')
</html>
