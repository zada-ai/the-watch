<!-- Footer Section -->
<footer class="w-full bg-black border-t border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 py-12 md:py-16">
        
        <!-- Logo Section -->
        <div class="flex items-center justify-center mb-12">
            <img src="{{ asset('LOGO/The-watch-logo.svg') }}"
                 class="w-16 h-16 object-contain rounded-xl bg-white/10 p-2"
                 alt="The Watch Logo">
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            
            <!-- Categories Section -->
            <div class="lg:col-span-2">
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-6">
                    
                    <!-- Watches Category -->
                    <div>
                        <button onclick="toggleFooterCategory('watches')" 
                                class="w-full text-left py-2 px-3 text-white font-bold text-sm md:text-base hover:text-amber-400 transition flex items-center justify-between">
                            <span>Watches</span>
                            <span id="watches-icon" class="transition-transform duration-300">▾</span>
                        </button>
                        <ul id="watches-submenu" class="hidden mt-2 space-y-2 pl-3 border-l border-white/20">
                            <li><a href="{{ route('watches') }}?gender=men" class="text-gray-300 hover:text-white text-xs md:text-sm transition">Men</a></li>
                            <li><a href="{{ route('watches') }}?gender=women" class="text-gray-300 hover:text-white text-xs md:text-sm transition">Women</a></li>
                        </ul>
                    </div>

                    <!-- Headphones Category -->
                    <div>
                        <button onclick="toggleFooterCategory('headphones')" 
                                class="w-full text-left py-2 px-3 text-white font-bold text-sm md:text-base hover:text-amber-400 transition flex items-center justify-between">
                            <span>Headphones</span>
                            <span id="headphones-icon" class="transition-transform duration-300">▾</span>
                        </button>
                        <ul id="headphones-submenu" class="hidden mt-2 space-y-2 pl-3 border-l border-white/20">
                            <li><a href="{{ route('headphones') }}?gender=men" class="text-gray-300 hover:text-white text-xs md:text-sm transition">Men</a></li>
                            <li><a href="{{ route('headphones') }}?gender=women" class="text-gray-300 hover:text-white text-xs md:text-sm transition">Women</a></li>
                        </ul>
                    </div>

                    <!-- Airbuds Category -->
                    <div>
                        <button onclick="toggleFooterCategory('airbuds')" 
                                class="w-full text-left py-2 px-3 text-white font-bold text-sm md:text-base hover:text-amber-400 transition flex items-center justify-between">
                            <span>Airbuds</span>
                            <span id="airbuds-icon" class="transition-transform duration-300">▾</span>
                        </button>
                        <ul id="airbuds-submenu" class="hidden mt-2 space-y-2 pl-3 border-l border-white/20">
                            <li><a href="{{ route('airbuds') }}?gender=men" class="text-gray-300 hover:text-white text-xs md:text-sm transition">Men</a></li>
                            <li><a href="{{ route('airbuds') }}?gender=women" class="text-gray-300 hover:text-white text-xs md:text-sm transition">Women</a></li>
                        </ul>
                    </div>

                    <!-- Perfume Category -->
                    <div>
                        <button onclick="toggleFooterCategory('perfume')" 
                                class="w-full text-left py-2 px-3 text-white font-bold text-sm md:text-base hover:text-amber-400 transition flex items-center justify-between">
                            <span>Perfume</span>
                            <span id="perfume-icon" class="transition-transform duration-300">▾</span>
                        </button>
                        <ul id="perfume-submenu" class="hidden mt-2 space-y-2 pl-3 border-l border-white/20">
                            <li><a href="{{ route('perfume.men') }}" class="text-gray-300 hover:text-white text-xs md:text-sm transition">Men</a></li>
                            <li><a href="{{ route('perfume.women') }}" class="text-gray-300 hover:text-white text-xs md:text-sm transition">Women</a></li>
                        </ul>
                    </div>

                    <!-- Wallets Category -->
                    <div>
                        <button onclick="toggleFooterCategory('wallets')" 
                                class="w-full text-left py-2 px-3 text-white font-bold text-sm md:text-base hover:text-amber-400 transition flex items-center justify-between">
                            <span>Wallets</span>
                            <span id="wallets-icon" class="transition-transform duration-300">▾</span>
                        </button>
                        <ul id="wallets-submenu" class="hidden mt-2 space-y-2 pl-3 border-l border-white/20">
                            <li><a href="{{ route('wallets.men') }}" class="text-gray-300 hover:text-white text-xs md:text-sm transition">Men</a></li>
                            <li><a href="{{ route('wallets.women') }}" class="text-gray-300 hover:text-white text-xs md:text-sm transition">Women</a></li>
                        </ul>
                    </div>

                    <!-- Toys Category -->
                    <div>
                        <button onclick="toggleFooterCategory('toys')" 
                                class="w-full text-left py-2 px-3 text-white font-bold text-sm md:text-base hover:text-amber-400 transition flex items-center justify-between">
                            <span>Toys</span>
                            <span id="toys-icon" class="transition-transform duration-300">▾</span>
                        </button>
                        <ul id="toys-submenu" class="hidden mt-2 space-y-2 pl-3 border-l border-white/20">
                            <li><a href="{{ route('toys.kids') }}" class="text-gray-300 hover:text-white text-xs md:text-sm transition">Kids</a></li>
                            <li><a href="{{ route('toys.smart') }}" class="text-gray-300 hover:text-white text-xs md:text-sm transition">Smart</a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <!-- Contact Section -->
            <div class="bg-white/5 rounded-xl p-6 border border-white/10">
                <h3 class="text-white font-bold text-lg mb-4">Contact Us</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-wide">Email</p>
                        <a href="mailto:sohaibmehmood0067@gmail.com" class="text-white hover:text-amber-400 transition text-sm md:text-base font-semibold break-all">
                            sohaibmehmood0067@gmail.com
                        </a>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-wide">Phone</p>
                        <a href="tel:+923185648065" class="text-white hover:text-amber-400 transition text-sm md:text-base font-semibold">
                            +92 318 5648065
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Newsletter Subscriber Section -->
        <div class="bg-gradient-to-r from-amber-600/20 to-amber-500/10 border border-amber-500/30 rounded-xl p-6 md:p-8 mb-8">
            <h3 class="text-white font-bold text-lg md:text-xl mb-2">Subscribe to Our Newsletter</h3>
            <p class="text-gray-300 text-sm mb-4">Get exclusive deals and updates delivered to your inbox.</p>
            
            <form id="footerSubscribeForm" class="flex flex-col sm:flex-row gap-3">
                <label class="sr-only" for="footerSubscribeEmail">Email</label>
                <input id="footerSubscribeEmail" type="email" placeholder="Enter your email..." 
                       class="flex-1 px-4 py-3 rounded-full bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400" />
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-3 rounded-full font-semibold whitespace-nowrap transition">
                    Subscribe
                </button>
            </form>
            <p id="footerSubscribeMsg" class="mt-3 text-sm text-amber-300 hidden"></p>
        </div>

        <!-- Footer Bottom -->
        <div class="border-t border-white/10 pt-8 text-center">
            <p class="text-gray-400 text-xs md:text-sm">
                &copy; 2026 The Watch. All rights reserved. | 
                <a href="https://wa.me/923185648065" target="_blank" class="text-amber-400 hover:text-amber-300 transition">Customer Support</a>
            </p>
        </div>
    </div>

    <!-- Thank You Popup Modal -->
    <div id="footerSubscribeModal" class="hidden fixed inset-0 bg-black/60 items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-900 rounded-xl max-w-md w-full mx-4 p-6 text-center shadow-2xl">
            <button class="absolute top-4 right-4 text-gray-700 hover:text-gray-900" aria-label="Close" onclick="closeFooterSubscribeModal()">✕</button>
            <div class="py-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Thank You! 🎉</h3>
                <p class="text-gray-700 dark:text-gray-300">You've successfully subscribed to our newsletter. Check your inbox for exclusive offers!</p>
            </div>
            <div class="mt-4">
                <button onclick="closeFooterSubscribeModal()" class="bg-amber-500 hover:bg-amber-600 text-white px-5 py-2 rounded-full font-semibold">OK</button>
            </div>
        </div>
    </div>

</footer>

<style>
    /* Hide scrollbar but keep scroll functionality */
    .overflow-x-auto {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .overflow-x-auto::-webkit-scrollbar {
        display: none;
    }
</style>

<script>
    // Toggle Footer Category Submenu
    function toggleFooterCategory(category) {
        const submenu = document.getElementById(category + '-submenu');
        const icon = document.getElementById(category + '-icon');
        
        if (submenu) {
            submenu.classList.toggle('hidden');
            if (icon) icon.classList.toggle('rotate-180');
        }
    }

    // Footer Subscribe Form Handler
    document.addEventListener('DOMContentLoaded', function(){
        const form = document.getElementById('footerSubscribeForm');
        const emailInput = document.getElementById('footerSubscribeEmail');
        const msg = document.getElementById('footerSubscribeMsg');

        if (!form) return;

        form.addEventListener('submit', function(e){
            e.preventDefault();
            msg.classList.add('hidden');

            const email = emailInput.value.trim();

            if (!email) {
                msg.textContent = 'Please enter your email address.';
                msg.classList.remove('hidden');
                return;
            }

            if (!/^\S+@\S+\.\S+$/.test(email)) {
                msg.textContent = 'Please enter a valid email address.';
                msg.classList.remove('hidden');
                return;
            }

            // Show thank you popup
            const modal = document.getElementById('footerSubscribeModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                
                // Auto-close after 5 seconds
                setTimeout(() => {
                    if (modal) {
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    }
                }, 5000);
            }

            // Clear input
            emailInput.value = '';
        });
    });

    // Close modal function and ESC handler
    function closeFooterSubscribeModal() {
        const modal = document.getElementById('footerSubscribeModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    document.addEventListener('keydown', function(e){
        if (e.key === 'Escape') closeFooterSubscribeModal();
    });
</script>
