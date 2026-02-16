<!-- Hero Section Badges/Logos Grid -->
<div class="w-full py-12 md:py-20 px-4 md:px-6 bg-gray-900">
    <div class="max-w-7xl mx-auto">
        
        <!-- Section Title -->
        <h2 class="text-2xl md:text-4xl font-bold text-white text-center mb-12">Why Choose Us</h2>
        
        <!-- Images Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 w-full">


            <!-- Placeholder for more images (add as needed) -->
            @php
                $items = [
                    ['image' => 'best_seller_badge_85x85.png', 'title' => 'Best Seller', 'link' => '/watches'],
                    ['image' => 'earbuds_d67c1f20-fbeb-4e47-abf2-fb78889efa40_85x85.png', 'title' => 'Premium Earbuds', 'link' => '/earbuds'],
                    ['image' => 'smartwatches_2_85x85.png', 'title' => 'Smart Watches', 'link' => '/smartwatches'],
                    ['image' => 'headphone_85x85.png', 'title' => 'Headphones', 'link' => '/headphones']
                ];
            @endphp

            @foreach($items as $item)
                <div class="flex flex-col items-center justify-center transition group hover:scale-110 duration-300">
                    <a href="{{ $item['link'] }}" class="flex flex-col items-center justify-center w-full">
                    <img src="{{ asset('Herosectionlogo/' . $item['image']) }}" alt="{{ $item['title'] }}" class="h-20 md:h-32 object-contain filter brightness-110 mb-3 group-hover:brightness-150 transition">
                    
                    <h3 class="text-white text-xs md:text-base font-semibold text-center">{{ $item['title'] }}</h3>
                    </a>
                </div>
            @endforeach

        </div>

        <!-- Decorative divider -->
        <div class="mt-12 flex items-center justify-center gap-4">
            <div class="h-px bg-gradient-to-r from-transparent via-white/50 to-transparent flex-1"></div>
            <span class="text-white/50 text-sm">★</span>
            <div class="h-px bg-gradient-to-r from-transparent via-white/50 to-transparent flex-1"></div>
        </div>

    </div>
</div>
