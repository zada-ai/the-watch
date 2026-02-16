<div id="{{ $card['id'] }}" class="group relative bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
    <div class="flex flex-col">
        <div class="relative overflow-hidden bg-gray-100">
            <img data-images='@json($card['images'])' src="{{ $card['images'][0] }}" alt="{{ $card['name'] }}" class="card-main-img w-full h-56 object-contain transition-transform duration-500 group-hover:scale-105">
            <div class="absolute top-3 left-3 z-10 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full">SALE</div>
            
            <!-- Discount Badge -->
            <div class="absolute top-3 right-3 bg-red-600 text-white px-3 py-1 rounded-lg font-bold text-sm">{{ $card['discount'] ?? rand(15, 60) }}% OFF</div>
            
            <div class="absolute bottom-3 right-3 bg-black/70 text-white px-3 py-2 rounded-xl text-right">
                <div class="text-xs line-through opacity-80"><span class="orig-price">{{ $card['orig_price'] }}</span></div>
                <div class="text-lg font-bold text-amber-400"><span class="sale-price">{{ $card['sale_price'] }}</span></div>
            </div>
        </div>

        <div class="p-4 sm:p-5 flex flex-col gap-3 bg-white">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <h3 class="text-gray-900 text-lg font-semibold">{{ $card['name'] }}</h3>
                    <p class="text-gray-600 text-sm mt-1">Premium • Water Resistant • 2 Year Warranty</p>
                </div>
                <!-- Star Rating on Right -->
                <div class="text-right ml-2">
                    <div class="flex items-center gap-1 justify-end">
                        <span class="text-yellow-400">★</span>
                        <span class="text-gray-900 font-bold">{{ $card['rating'] ?? number_format(rand(40, 50) / 10, 1) }}</span>
                    </div>
                    <p class="text-gray-600 text-xs">({{ $card['reviews'] ?? rand(150, 5000) }} reviews)</p>
                </div>
            </div>

            <ul class="text-sm text-gray-700 space-y-1">
                <li>✔ Best Seller</li>
                <li>✔ Premium Finish</li>
                <li>✔ Limited Edition</li>
            </ul>

            <div class="flex items-center justify-between pt-2">
                <div class="flex gap-2">
                    <!-- Red color -> image index 1 -->
                    <button data-index="1" class="color-dot w-5 h-5 rounded-full hover:scale-110 transition ring-1 ring-gray-300" style="background:#ef4444;"></button>
                    <!-- Grey color -> image index 2 -->
                    <button data-index="2" class="color-dot w-5 h-5 rounded-full hover:scale-110 transition ring-1 ring-gray-300" style="background:#6b7280;"></button>
                </div>

                <a href="#" class="buy-now inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-4 py-2 rounded-xl transition">
                    Buy Now {{ $card['sale_price'] }}</span></span>
                </a>
            </div>
        </div>
    </div>
</div>
