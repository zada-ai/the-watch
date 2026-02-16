<nav class="bg-black/40 backdrop-blur-md fixed top-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
          <button id="mobileMenuToggle" class="md:hidden text-white hover:text-amber-400 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        <!-- LEFT: LOGO -->
        <div class="flex items-center gap-2">
            <a href="{{ route('user.home') }}" class="inline-block">
                <img src="{{ asset('LOGO/The-watch-logo.svg') }}"
                     class="w-14 h-14 object-contain rounded-xl bg-white/20 p-2"
                     alt="The Watch">
            </a>
        </div>

        <!-- CENTER: CATEGORIES -->
        <ul class="hidden md:flex gap-8 text-sm font-semibold text-white">
             <a href="{{ route('user.home') }}"
   class="relative after:absolute after:left-0 after:-bottom-1 
          after:h-[2px] after:w-full after:bg-white
          after:scale-x-0 after:origin-right
          hover:after:scale-x-100 hover:after:origin-left
          after:transition-transform after:duration-300">
    Home
</a>
            
            <!-- Watches with Dropdown -->
            <li class="relative group">
                <a href="{{ route('watches') }}"
                   class="relative after:absolute after:left-0 after:-bottom-1 
                          after:h-[2px] after:w-full after:bg-white
                          after:scale-x-0 after:origin-right
                          hover:after:scale-x-100 hover:after:origin-left
                          after:transition-transform after:duration-300">
                    Watches
                </a>
                
                <!-- Dropdown Menu -->
                <div class="absolute left-0 mt-0 hidden group-hover:flex flex-col bg-black/90 backdrop-blur-md rounded-lg overflow-hidden min-w-max z-40">
                    <a href="{{ route('watches') }}?gender=men" class="px-4 py-3 text-white hover:bg-amber-500/30 transition">
                        Men
                    </a>
                    <a href="{{ route('watches') }}?gender=women" class="px-4 py-3 text-white hover:bg-amber-500/30 transition border-t border-white/10">
                        Women
                    </a>
                </div>
            </li>

            <li><a href="{{ route('headphones') }}" class="relative after:absolute after:left-0 after:-bottom-1 
          after:h-[2px] after:w-full after:bg-white
          after:scale-x-0 after:origin-right
          hover:after:scale-x-100 hover:after:origin-left
          after:transition-transform after:duration-300">Headphones</a></li>

            <!-- Headphones with Dropdown -->
            <li class="relative group hidden">
                <a href="{{ route('headphones') }}"
                   class="relative after:absolute after:left-0 after:-bottom-1 
                          after:h-[2px] after:w-full after:bg-white
                          after:scale-x-0 after:origin-right
                          hover:after:scale-x-100 hover:after:origin-left
                          after:transition-transform after:duration-300">
                    Headphones
                </a>
                
                <!-- Dropdown Menu -->
                <div class="absolute left-0 mt-0 hidden group-hover:flex flex-col bg-black/90 backdrop-blur-md rounded-lg overflow-hidden min-w-max z-40">
                    <a href="{{ route('headphones') }}?gender=men" class="px-4 py-3 text-white hover:bg-amber-500/30 transition">
                        Men
                    </a>
                    <a href="{{ route('headphones') }}?gender=women" class="px-4 py-3 text-white hover:bg-amber-500/30 transition border-t border-white/10">
                        Women
                    </a>
                </div>
            </li>

            <!-- Airbuds with Dropdown -->
            <li class="relative group">
                <a href="{{ route('airbuds') }}"
                   class="relative after:absolute after:left-0 after:-bottom-1 
                          after:h-[2px] after:w-full after:bg-white
                          after:scale-x-0 after:origin-right
                          hover:after:scale-x-100 hover:after:origin-left
                          after:transition-transform after:duration-300">
                    Airbuds
                </a>
                
                <!-- Dropdown Menu -->
                <div class="absolute left-0 mt-0 hidden group-hover:flex flex-col bg-black/90 backdrop-blur-md rounded-lg overflow-hidden min-w-max z-40">
                    <a href="{{ route('airbuds') }}?gender=men" class="px-4 py-3 text-white hover:bg-amber-500/30 transition">
                        Men
                    </a>
                    <a href="{{ route('airbuds') }}?gender=women" class="px-4 py-3 text-white hover:bg-amber-500/30 transition border-t border-white/10">
                        Women
                    </a>
                </div>
            </li>

            <!-- Perfume with Dropdown -->
            <li class="relative group">
                <a href="{{ route('perfume') }}"
                   class="relative after:absolute after:left-0 after:-bottom-1 
                          after:h-[2px] after:w-full after:bg-white
                          after:scale-x-0 after:origin-right
                          hover:after:scale-x-100 hover:after:origin-left
                          after:transition-transform after:duration-300">
                    Perfume
                </a>
                
                <!-- Dropdown Menu -->
                <div class="absolute left-0 mt-0 hidden group-hover:flex flex-col bg-black/90 backdrop-blur-md rounded-lg overflow-hidden min-w-max z-40">
                    <a href="{{ route('perfume.men') }}" class="px-4 py-3 text-white hover:bg-amber-500/30 transition">
                        Men
                    </a>
                    <a href="{{ route('perfume.women') }}" class="px-4 py-3 text-white hover:bg-amber-500/30 transition border-t border-white/10">
                        Women
                    </a>
                </div>
            </li>

            <!-- Wallets with Dropdown -->
            <li class="relative group hidden">
                <a href="{{ route('wallets') }}"
                   class="relative after:absolute after:left-0 after:-bottom-1 
                          after:h-[2px] after:w-full after:bg-white
                          after:scale-x-0 after:origin-right
                          hover:after:scale-x-100 hover:after:origin-left
                          after:transition-transform after:duration-300">
                    Wallets
                </a>
                
                <!-- Dropdown Menu -->
                <div class="absolute left-0 mt-0 hidden group-hover:flex flex-col bg-black/90 backdrop-blur-md rounded-lg overflow-hidden min-w-max z-40">
                    <a href="{{ route('wallets.men') }}" class="px-4 py-3 text-white hover:bg-amber-500/30 transition">
                        Men
                    </a>
                    <a href="{{ route('wallets.women') }}" class="px-4 py-3 text-white hover:bg-amber-500/30 transition border-t border-white/10">
                        Women
                    </a>
                </div>
            </li>

            <!-- Toys with Dropdown -->
            <li class="relative group hidden">
                <a href="{{ route('toys') }}"
                   class="relative after:absolute after:left-0 after:-bottom-1 
                          after:h-[2px] after:w-full after:bg-white
                          after:scale-x-0 after:origin-right
                          hover:after:scale-x-100 hover:after:origin-left
                          after:transition-transform after:duration-300">
                    Toys
                </a>
                
                <!-- Dropdown Menu -->
                <div class="absolute left-0 mt-0 hidden group-hover:flex flex-col bg-black/90 backdrop-blur-md rounded-lg overflow-hidden min-w-max z-40">
                    <a href="{{ route('toys.kids') }}" class="px-4 py-3 text-white hover:bg-amber-500/30 transition">
                        Kids
                    </a>
                    <a href="{{ route('toys.smart') }}" class="px-4 py-3 text-white hover:bg-amber-500/30 transition border-t border-white/10">
                        Smart
                    </a>
                </div>
            </li>

            <li><a href="{{ route('wallets') }}" class="relative after:absolute after:left-0 after:-bottom-1 
          after:h-[2px] after:w-full after:bg-white
          after:scale-x-0 after:origin-right
          hover:after:scale-x-100 hover:after:origin-left
          after:transition-transform after:duration-300">wallets</a></li>
            <li><a href="{{ route('toys') }}" class="relative after:absolute after:left-0 after:-bottom-1 
          after:h-[2px] after:w-full after:bg-white
          after:scale-x-0 after:origin-right
          hover:after:scale-x-100 hover:after:origin-left
          after:transition-transform after:duration-300">Toys</a></li>
            <li><a href="https://wa.me/923185648065" target="_blank" class="relative after:absolute after:left-0 after:-bottom-1 
          after:h-[2px] after:w-full after:bg-white
          after:scale-x-0 after:origin-right
          hover:after:scale-x-100 hover:after:origin-left
          after:transition-transform after:duration-300">Customer Support</a></li>
        </ul>

        <!-- HAMBURGER MENU (Mobile) -->
      

        <!-- RIGHT: ICONS -->
        <div class="hidden md:flex items-center gap-5 relative">

            <!-- EXCLUSIVE COLLECTIONS LINK -->
            

            <!-- SEARCH ICON -->
            <button id="searchToggle" class="text-white hover:text-amber-400 transition">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
</svg>

            </button>

            <!-- SEARCH INPUT (HIDDEN) -->
            <div id="searchBox"
                 class="absolute right-12 top-1/2 -translate-y-1/2 hidden">
                <form action="{{ route('search') }}" method="GET" class="flex">
                    <input type="text" name="q" placeholder="Search products..."
                           class="px-4 py-2 rounded-l-full bg-white text-black w-52 focus:outline-none">
                    <button type="submit"
                            class="bg-amber-500 px-4 rounded-r-full font-semibold">
                        Go
                    </button>
                </form>
            </div>

            <!-- CART ICON -->
            <a href="{{ route('cart') }}" class="relative text-white hover:text-amber-400 transition">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
</svg>

                <span class="absolute -top-2 -right-3 bg-red-500 text-xs w-5 h-5
                             flex items-center justify-center rounded-full">
                    0
                </span>
            </a>

        </div>

        <!-- MOBILE RIGHT ICONS -->
        <div class="md:hidden flex items-center gap-4">
            <!-- SEARCH ICON -->
            <button id="searchToggleMobile" class="text-white hover:text-amber-400 transition">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
</svg>

            </button>

            <!-- CART ICON -->
            <a href="{{ route('cart') }}" class="relative text-white hover:text-amber-400 transition">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
</svg>

                <span class="absolute -top-2 -right-3 bg-red-500 text-xs w-5 h-5
                             flex items-center justify-center rounded-full">
                    0
                </span>
            </a>
        </div>
    </div>

    <!-- MOBILE MENU (Collapsible) -->
<!-- MOBILE MENU -->
<div id="mobileMenu"
     class="fixed top-0 left-0 h-full w-[50%] sm:w-[50%]
            md:hidden hidden
            bg-black/70 
            border-l border-white/10
            z-50 transition-all duration-300">

    <!-- Header -->
    <div class="flex items-center justify-between px-5 py-4 border-b border-white/10">
        <span class="text-white font-bold flex justify-center items-center tracking-wide">Menu</span>

        <!-- Close Icon -->
        <button onclick="toggleMobileMenu()"
                class="text-white text-2xl leading-none hover:text-amber-400 transition">
            ✕
        </button>
    </div>

    <!-- Menu Items -->
    <ul class="flex flex-col py-4 px-4 text-sm bg-black text-white font-semibold">

    <li>
        <a href="{{ route('user.home') }}"
           class="block py-3 px-4 rounded hover:bg-white/10 transition">
            Home
        </a>
    </li>

    <!-- Watches (Toggle Button) -->
    <li>
        <button onclick="toggleWatchCategory()"
                class="w-full flex items-center justify-between
                       py-3 px-4 rounded hover:bg-white/10 transition">
            <span>Watches</span>
            <span id="watchIcon" class="transition-transform duration-300">▾</span>
        </button>

        <!-- Men / Women (Hidden by default) -->
        <ul id="watchSubMenu" class="hidden">
            <li>
                <a href="{{ route('watches') }}?gender=men"
                   class="block py-3 px-8 rounded hover:bg-white/10 transition text-amber-400">
                    Men Watches
                </a>
            </li>
            <li>
                <a href="{{ route('watches') }}?gender=women"
                   class="block py-3 px-8 rounded hover:bg-white/10 transition text-amber-400">
                    Women Watches
                </a>
            </li>
        </ul>
    </li>


    <!-- Headphones (Toggle Button) -->
    <!-- Headphones (Toggle Button) -->
    <li>
        <button onclick="toggleCategory('headphones')"
                class="w-full flex items-center justify-between
                       py-3 px-4 rounded hover:bg-white/10 transition">
            <span>Headphones</span>
            <span id="headphonesIcon" class="transition-transform duration-300">▾</span>
        </button>

        <!-- Men / Women (Hidden by default) -->
        <ul id="headphonesSubMenu" class="hidden">
            <li>
                <a href="{{ route('headphones.men') }}"
                   class="block py-3 px-8 rounded hover:bg-white/10 transition text-amber-400">
                    Men
                </a>
            </li>
            <li>
                <a href="{{ route('headphones.women') }}"
                   class="block py-3 px-8 rounded hover:bg-white/10 transition text-amber-400">
                    Women
                </a>
            </li>
        </ul>
    </li>

    <!-- Airbuds (Toggle Button) -->
    <li>
        <button onclick="toggleCategory('airbuds')"
                class="w-full flex items-center justify-between
                       py-3 px-4 rounded hover:bg-white/10 transition">
            <span>Airbuds</span>
            <span id="airbudsIcon" class="transition-transform duration-300">▾</span>
        </button>

        <!-- Men / Women (Hidden by default) -->
        <ul id="airbudsSubMenu" class="hidden">
            <li>
                <a href="{{ route('airbuds.men') }}"
                   class="block py-3 px-8 rounded hover:bg-white/10 transition text-amber-400">
                    Men
                </a>
            </li>
            <li>
                <a href="{{ route('airbuds.women') }}"
                   class="block py-3 px-8 rounded hover:bg-white/10 transition text-amber-400">
                    Women
                </a>
            </li>
        </ul>
    </li>

    <!-- Perfume (Toggle Button) -->
    <li>
        <button onclick="toggleCategory('perfume')"
                class="w-full flex items-center justify-between
                       py-3 px-4 rounded hover:bg-white/10 transition">
            <span>Perfume</span>
            <span id="perfumeIcon" class="transition-transform duration-300">▾</span>
        </button>

        <!-- Men / Women (Hidden by default) -->
        <ul id="perfumeSubMenu" class="hidden">
            <li>
                <a href="{{ route('perfume.men') }}"
                   class="block py-3 px-8 rounded hover:bg-white/10 transition text-amber-400">
                    Men
                </a>
            </li>
            <li>
                <a href="{{ route('perfume.women') }}"
                   class="block py-3 px-8 rounded hover:bg-white/10 transition text-amber-400">
                    Women
                </a>
            </li>
        </ul>
    </li>

    <!-- Wallets (Toggle Button) -->
    <li>
        <button onclick="toggleCategory('wallets')"
                class="w-full flex items-center justify-between
                       py-3 px-4 rounded hover:bg-white/10 transition">
            <span>Wallets</span>
                <span class="text-xs text-amber-400">Coming Soon</span>
        </button>
    </li>

    <!-- Toys (Toggle Button) -->
    <li>
        <button onclick="toggleCategory('toys')"
                class="w-full flex items-center justify-between
                       py-3 px-4 rounded hover:bg-white/10 transition">
            <span>Toys</span>
            <span class="text-xs text-amber-400">Coming Soon</span>
        </button>
    </li>

    <li><a href="https://wa.me/923185648065" target="_blank" class="block py-3 px-4 rounded hover:bg-white/10 transition">Customer Support</a></li>

</ul>

</div>


    <!-- SEARCH INPUT (MOBILE) -->
   <div id="searchBoxMobile"
     class="fixed top-0 right-0 h-full w-[85%] sm:w-[75%]
            md:hidden hidden
            bg-black/70 backdrop-blur-md
            border-l border-white/10
            z-50 p-5">

    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <span class="text-white font-bold">Search</span>
        <button onclick="toggleSearchMobile()"
                class="text-white text-2xl hover:text-amber-400 transition">
            ✕
        </button>
    </div>

    <form action="{{ route('search') }}" method="GET" class="flex gap-2">
        <input type="text" name="q" placeholder="Search products..."
               class="flex-1 px-4 py-2 rounded-full bg-white text-black focus:outline-none">
        <button type="submit"
                class="bg-amber-500 px-4 rounded-full font-semibold text-white hover:bg-amber-600 transition">
            Go
        </button>
    </form>
</div>

</nav>
<style>
/* Whole bar slide animation */
.mobile-slide{
    animation: slideBar 0.8s ease-out forwards;
}

/* Individual buttons animation */
.mobile-btn{
    position: relative;
    animation: slideItem 0.6s ease-out forwards;
}

/* Delay for nice flow */
.mobile-btn:nth-child(1){ animation-delay: .1s }
.mobile-btn:nth-child(2){ animation-delay: .2s }
.mobile-btn:nth-child(3){ animation-delay: .3s }
.mobile-btn:nth-child(4){ animation-delay: .4s }
.mobile-btn:nth-child(5){ animation-delay: .5s }

/* Underline animation */
.mobile-btn::after{
    content:'';
    position:absolute;
    left:0;
    bottom:-4px;
    width:100%;
    height:2px;
    background:white;
    transform:scaleX(0);
    transform-origin:left;
    transition:transform .3s ease;
}

.mobile-btn:hover::after{
    transform:scaleX(1);
}

/* KEYFRAMES */
@keyframes slideBar{
    from{
        transform:translateX(-40px);
        opacity:0;
    }
    to{
        transform:translateX(0);
        opacity:1;
    }
}

@keyframes slideItem{
    from{
        transform:translateX(-30px);
        opacity:0;
    }
    to{
        transform:translateX(0);
        opacity:1;
    }
}

/* Mobile menu animation */
#mobileMenu:not(.hidden) {
    animation: slideDown 0.3s ease-out;
}

#searchBoxMobile:not(.hidden) {
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
    // Toggle Mobile Menu
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('hidden');
    }

    // Toggle Search Mobile
    function toggleSearchMobile() {
        const searchBoxMobile = document.getElementById('searchBoxMobile');
        searchBoxMobile.classList.toggle('hidden');
    }

    // Toggle Hamburger Menu
    document.getElementById('mobileMenuToggle').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobileMenu');
        const searchBoxMobile = document.getElementById('searchBoxMobile');
        
        if (mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.remove('hidden');
            searchBoxMobile.classList.add('hidden');
        } else {
            mobileMenu.classList.add('hidden');
        }
    });

    // Toggle Search Box (Desktop)
    document.getElementById('searchToggle').addEventListener('click', function() {
        const searchBox = document.getElementById('searchBox');
        if (searchBox.classList.contains('hidden')) {
            searchBox.classList.remove('hidden');
        } else {
            searchBox.classList.add('hidden');
        }
    });

    // Toggle Search Box (Mobile)
    document.getElementById('searchToggleMobile').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobileMenu');
        const searchBoxMobile = document.getElementById('searchBoxMobile');
        
        if (searchBoxMobile.classList.contains('hidden')) {
            searchBoxMobile.classList.remove('hidden');
            mobileMenu.classList.add('hidden');
        } else {
            searchBoxMobile.classList.add('hidden');
        }
    });

    // Close menu when a link is clicked
    document.querySelectorAll('#mobileMenu a').forEach(link => {
        link.addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.add('hidden');
        });
    });
    
    // Toggle Watch Category
    function toggleWatchCategory() {
        const submenu = document.getElementById('watchSubMenu');
        const icon = document.getElementById('watchIcon');

        submenu.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }

    // Toggle Category (Generic function for all categories)
    function toggleCategory(category) {
        const submenu = document.getElementById(category + 'SubMenu');
        const icon = document.getElementById(category + 'Icon');

        submenu.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }

</script>
