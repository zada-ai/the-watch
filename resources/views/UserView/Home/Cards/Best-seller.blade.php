@php
    // Fetch Best Seller data from database grouped by category
    use App\Models\BestSeller;
    
    $watches = BestSeller::where('category', 'watches')
        ->where('active', true)
        ->orderBy('created_at', 'desc')
        ->get();
    
    $headphones = BestSeller::where('category', 'headphones')
        ->where('active', true)
        ->orderBy('created_at', 'desc')
        ->get();
    
    $airbuds = BestSeller::where('category', 'airbuds')
        ->where('active', true)
        ->orderBy('created_at', 'desc')
        ->get();
@endphp

<section class="w-full py-16 px-4 md:px-6 bg-gradient-to-b from-gray-900 via-gray-950 to-black">
    <div class="max-w-7xl mx-auto">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-5xl font-black text-white mb-3">
                ⭐ Best Seller
            </h2>a
            <p class="text-amber-400 font-semibold text-lg">Customer Favorites</p>
        </div>

        <!-- Tab Buttons -->
      <div class="flex gap-3 mb-12 flex-wrap justify-center md:justify-end">
    <button 
        class="bestseller-tab-btn active 
               w-full sm:w-auto
               px-6 py-2 rounded-full text-sm font-semibold
               
               bg-transparent
               text-white
               transition-all duration-300
               hover:bg-amber-500 hover:text-white
               hover:scale-105"
        data-tab="bestseller-watches">
        Watches
    </button>

    <button 
        class="bestseller-tab-btn 
               w-full sm:w-auto
               px-6 py-2 rounded-full text-sm font-semibold
               
               bg-transparent
               text-white
               transition-all duration-300
               hover:bg-blue-500 hover:text-white
               hover:scale-105"
        data-tab="bestseller-headphones">
        Headphones
    </button>

    <button 
        class="bestseller-tab-btn 
               w-full sm:w-auto
               px-6 py-2 rounded-full text-sm font-semibold
               
               bg-transparent
               text-white
               transition-all duration-300
               hover:bg-purple-500 hover:text-white
               hover:scale-105"
        data-tab="bestseller-airbuds">
        Airbuds
    </button>
</div>


        <!-- Watches Tab -->
        <div id="bestseller-watches-content" class="bestseller-tab-content">
            <div class="
    grid grid-cols-2 md:grid-cols-3 sm:grid-cols-2 gap-4 pb-4
">

                @forelse($watches as $item)
     <div class="
    w-full
    snap-center
    bg-gradient-to-br from-gray-900 to-gray-800
    rounded-lg sm:rounded-xl
    p-2 sm:p-3 md:p-4
    shadow-md
">


                    <div class="relative">
                    @php
                        $image = null;
                        if (!empty($item->images)) {
                            if (isset($item->images[0])) {
                                $image = $item->images[0];
                            } elseif (is_array($item->images)) {
                                $firstColor = array_key_first($item->images);
                                $image = $item->images[$firstColor][0] ?? null;
                            }
                        }

                        $src = asset('images/no-image.png');
                        if ($image) {
                            if (str_starts_with($image, 'http')) {
                                $src = $image;
                            } elseif (file_exists(public_path($image))) {
                                $src = asset($image);
                            } elseif (str_starts_with($image, '/storage/') || str_starts_with($image, 'storage/')) {
                                $clean = preg_replace('#^/storage/#', '', $image);
                                $clean = preg_replace('#^storage/#', '', $clean);
                                if (file_exists(storage_path('app/public/' . $clean))) {
                                    $src = asset('storage/' . $clean);
                                } else {
                                    $src = asset($clean);
                                }
                            } elseif (str_contains($image, 'best-seller-assets')) {
                                if (file_exists(public_path($image))) {
                                    $src = asset($image);
                                } elseif (file_exists(storage_path('app/public/' . ltrim($image, '/')))) {
                                    $src = asset('storage/' . ltrim($image, '/'));
                                } else {
                                    $src = asset(ltrim($image, '/'));
                                }
                            } elseif (file_exists(storage_path('app/public/' . ltrim($image, '/')))) {
                                $src = asset('storage/' . ltrim($image, '/'));
                            } else {
                                $src = asset(ltrim($image, '/'));
                            }
                        }
                    @endphp

                    <img
                        id="product-img-{{ $item->id }}"
                        src="{{ $src }}"
                        data-images='@json($item->images ?? [])'
                        data-index="0"
                        data-product="{{ $item->id }}"
                       
    class="
        w-full
        h-36 sm:h-44 md:h-56
        object-cover
        rounded-md sm:rounded-lg
        mb-2 sm:mb-3
    "
/>

                    <div class="absolute top-3 right-3 bg-white/10 text-white px-3 py-1 rounded">-{{ $item->discount }}%</div>
                    </div>
                    <h3 class="text-white font-bold text-sm sm:text-base md:text-lg mb-1">{{ $item->name }}</h3>
                  <p class="text-gray-400 text-xs sm:text-sm mb-2">des: {{ $item->descri }}</p>
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-lg sm:text-xl md:text-2xl font-extrabold text-amber-400">
Rs {{ number_format($item->sale_price) }}</div>
                            <div class="text-xs text-gray-400 line-through">Rs {{ number_format($item->orig_price) }}</div>
                          @if(!empty($item->colors))
<div class="flex gap-2 mt-2">
    @foreach($item->colors as $colorName => $colorCode)
        <label class="cursor-pointer">
           <input
                type="radio"
                name="color_{{ $item->id }}"
                class="sr-only"
                data-product="{{ $item->id }}"
                data-color="{{ $colorName }}"
                data-images='@json($item->images[$colorName] ?? [])'
            >
            <span
                title="{{ ucfirst($colorName) }}"
                class="w-6 h-6 rounded-full border border-white/50 inline-block"
                style="background-color: {{ $colorCode }}"
            ></span>
        </label>
    @endforeach
</div>
@endif



                        </div>
                        
                    </div>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('buy', ['type' => 'bestseller', 'id' => $item->id]) }}" class="flex-1 text-center text-xs sm:text-sm bg-amber-500 hover:bg-amber-600 text-white py-1.5 sm:py-2 rounded-md">Buy Now</a>
                        <a href="{{ route('watches') }}" class="flex-1 text-center text-xs sm:text-sm border border-white/10 text-white py-1.5 sm:py-2 rounded-md">View More</a>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center text-gray-400 py-8">No active watches found</div>
                @endforelse
            </div>
        </div>

        <!-- Headphones Tab -->
        <div id="bestseller-headphones-content" class="bestseller-tab-content hidden">
            <div class="
    grid grid-cols-1 sm:grid-cols-2 gap-4 pb-4
">

                @forelse($headphones as $item)
     <div class="
    w-full
    snap-center
    bg-gradient-to-br from-gray-900 to-gray-800
    rounded-lg sm:rounded-xl
    p-2 sm:p-3 md:p-4
    shadow-md
">


                    <div class="relative">
                    @php
                        $image = null;
                        if (!empty($item->images)) {
                            if (isset($item->images[0])) {
                                $image = $item->images[0];
                            } elseif (is_array($item->images)) {
                                $firstColor = array_key_first($item->images);
                                $image = $item->images[$firstColor][0] ?? null;
                            }
                        }

                        $src = asset('images/no-image.png');
                        if ($image) {
                            if (str_starts_with($image, 'http')) {
                                $src = $image;
                            } elseif (file_exists(public_path($image))) {
                                $src = asset($image);
                            } elseif (str_starts_with($image, '/storage/') || str_starts_with($image, 'storage/')) {
                                $clean = preg_replace('#^/storage/#', '', $image);
                                $clean = preg_replace('#^storage/#', '', $clean);
                                if (file_exists(storage_path('app/public/' . $clean))) {
                                    $src = asset('storage/' . $clean);
                                } else {
                                    $src = asset($clean);
                                }
                            } elseif (str_contains($image, 'best-seller-assets')) {
                                if (file_exists(public_path($image))) {
                                    $src = asset($image);
                                } elseif (file_exists(storage_path('app/public/' . ltrim($image, '/')))) {
                                    $src = asset('storage/' . ltrim($image, '/'));
                                } else {
                                    $src = asset(ltrim($image, '/'));
                                }
                            } elseif (file_exists(storage_path('app/public/' . ltrim($image, '/')))) {
                                $src = asset('storage/' . ltrim($image, '/'));
                            } else {
                                $src = asset(ltrim($image, '/'));
                            }
                        }
                    @endphp

                    <img
                        id="product-img-{{ $item->id }}"
                        src="{{ $src }}"
                        data-images='@json($item->images ?? [])'
                        data-index="0"
                        data-product="{{ $item->id }}"
                       
    class="
        w-full
        h-36 sm:h-44 md:h-56
        object-cover
        rounded-md sm:rounded-lg
        mb-2 sm:mb-3
    "
/>

                    <div class="absolute top-3 right-3 bg-white/10 text-white px-3 py-1 rounded">-{{ $item->discount }}%</div>
                    </div>
                    <h3 class="text-white font-bold text-sm sm:text-base md:text-lg mb-1">{{ $item->name }}</h3>
                  <p class="text-gray-400 text-xs sm:text-sm mb-2">des: {{ $item->descri }}</p>
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-lg sm:text-xl md:text-2xl font-extrabold text-amber-400">
Rs {{ number_format($item->sale_price) }}</div>
                            <div class="text-xs text-gray-400 line-through">Rs {{ number_format($item->orig_price) }}</div>
                          @if(!empty($item->colors))
                            <div class="flex gap-2 mt-2">
                                @foreach($item->colors as $colorName => $colorCode)
                                <label class="cursor-pointer">
                                   <input
                                        type="radio"
                                        name="color_{{ $item->id }}"
                                        class="sr-only"
                                        data-product="{{ $item->id }}"
                                        data-color="{{ $colorName }}"
                                        data-images='@json($item->images[$colorName] ?? [])'
                                    >
                                    <span
                                        title="{{ ucfirst($colorName) }}"
                                        class="w-6 h-6 rounded-full border border-white/50 inline-block"
                                        style="background-color: {{ $colorCode }}"
                                    ></span>
                                </label>
                                @endforeach
                            </div>
                          @endif
                        </div>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('buy', ['type' => 'bestseller', 'id' => $item->id]) }}" class="flex-1 text-center text-xs sm:text-sm bg-amber-500 hover:bg-amber-600 text-white py-1.5 sm:py-2 rounded-md">Buy Now</a>
                        <a href="{{ route('headphones') }}" class="flex-1 text-center text-xs sm:text-sm border border-white/10 text-white py-1.5 sm:py-2 rounded-md">View More</a>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center text-gray-400 py-8">No active headphones found</div>
                @endforelse
            </div>
        </div>

        <!-- Airbuds Tab -->
        <div id="bestseller-airbuds-content" class="bestseller-tab-content hidden">
            <div class="
    grid grid-cols-1 sm:grid-cols-2 gap-4 pb-4
">

                @forelse($airbuds as $item)
     <div class="
    w-full
    snap-center
    bg-gradient-to-br from-gray-900 to-gray-800
    rounded-lg sm:rounded-xl
    p-2 sm:p-3 md:p-4
    shadow-md
">


                    <div class="relative">
                    @php
                        $image = null;
                        if (!empty($item->images)) {
                            if (isset($item->images[0])) {
                                $image = $item->images[0];
                            } elseif (is_array($item->images)) {
                                $firstColor = array_key_first($item->images);
                                $image = $item->images[$firstColor][0] ?? null;
                            }
                        }

                        $src = asset('images/no-image.png');
                        if ($image) {
                            if (str_starts_with($image, 'http')) {
                                $src = $image;
                            } elseif (file_exists(public_path($image))) {
                                $src = asset($image);
                            } elseif (str_starts_with($image, '/storage/') || str_starts_with($image, 'storage/')) {
                                $clean = preg_replace('#^/storage/#', '', $image);
                                $clean = preg_replace('#^storage/#', '', $clean);
                                if (file_exists(storage_path('app/public/' . $clean))) {
                                    $src = asset('storage/' . $clean);
                                } else {
                                    $src = asset($clean);
                                }
                            } elseif (str_contains($image, 'best-seller-assets')) {
                                if (file_exists(public_path($image))) {
                                    $src = asset($image);
                                } elseif (file_exists(storage_path('app/public/' . ltrim($image, '/')))) {
                                    $src = asset('storage/' . ltrim($image, '/'));
                                } else {
                                    $src = asset(ltrim($image, '/'));
                                }
                            } elseif (file_exists(storage_path('app/public/' . ltrim($image, '/')))) {
                                $src = asset('storage/' . ltrim($image, '/'));
                            } else {
                                $src = asset(ltrim($image, '/'));
                            }
                        }
                    @endphp

                    <img
                        id="product-img-{{ $item->id }}"
                        src="{{ $src }}"
                        data-images='@json($item->images ?? [])'
                        data-index="0"
                        data-product="{{ $item->id }}"
                      
    class="
        w-full
        h-36 sm:h-44 md:h-56
        object-cover
        rounded-md sm:rounded-lg
        mb-2 sm:mb-3
    "
/>

                    <div class="absolute top-3 right-3 bg-white/10 text-white px-3 py-1 rounded">-{{ $item->discount }}%</div>
                    </div>
                    <h3 class="text-white font-bold text-sm sm:text-base md:text-lg mb-1">{{ $item->name }}</h3>
                  <p class="text-gray-400 text-xs sm:text-sm mb-2">des: {{ $item->descri }}</p>
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-lg sm:text-xl md:text-2xl font-extrabold text-amber-400">
Rs {{ number_format($item->sale_price) }}</div>
                            <div class="text-xs text-gray-400 line-through">Rs {{ number_format($item->orig_price) }}</div>
                          @if(!empty($item->colors))
                            <div class="flex gap-2 mt-2">
                                @foreach($item->colors as $colorName => $colorCode)
                                <label class="cursor-pointer">
                                   <input
                                        type="radio"
                                        name="color_{{ $item->id }}"
                                        class="sr-only"
                                        data-product="{{ $item->id }}"
                                        data-color="{{ $colorName }}"
                                        data-images='@json($item->images[$colorName] ?? [])'
                                    >
                                    <span
                                        title="{{ ucfirst($colorName) }}"
                                        class="w-6 h-6 rounded-full border border-white/50 inline-block"
                                        style="background-color: {{ $colorCode }}"
                                    ></span>
                                </label>
                                @endforeach
                            </div>
                          @endif
                        </div>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('buy', ['type' => 'bestseller', 'id' => $item->id]) }}" class="flex-1 text-center text-xs sm:text-sm bg-amber-500 hover:bg-amber-600 text-white py-1.5 sm:py-2 rounded-md">Buy Now</a>
                        <a href="{{ route('airbuds') }}" class="flex-1 text-center text-xs sm:text-sm border border-white/10 text-white py-1.5 sm:py-2 rounded-md">View More</a>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center text-gray-400 py-8">No active airbuds found</div>
                @endforelse
            </div>
        </div>
    </div>
</section>


<div class="py-10 px-4 md:px-6 max-w-7xl mx-auto overflow-hidden">
    <img src="{{ asset('best-seller-assets/Warrunty.png') }}"
         alt="Warranty Banner"
         class="w-full h-auto rounded-lg shadow-lg hover:shadow-2xl transition-all duration-500 hover:scale-105 hover:-translate-y-2 animate-fadeIn">
</div>


<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fadeIn {
        animation: fadeIn 0.8s ease-out;
    }

    .bestseller-tab-content { animation: fadeIn 0.5s ease-in-out; }
    @keyframes pulse-slow {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.05); opacity: 0.8; }
    }
    .animate-pulse-slow { animation: pulse-slow 2s ease-in-out infinite; }

    .group:hover { 
        filter: drop-shadow(0 30px 40px rgba(217, 119, 6, 0.3));
    }

    .bestseller-tab-btn {
        font-size: 0.95rem;
        letter-spacing: 0.5px;
    }

    .bestseller-tab-btn.active {
        box-shadow: 0 10px 30px rgba(217, 119, 6, 0.4);
    }

    /* Hide scrollbar but keep scroll functionality */
    .overflow-x-auto {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .overflow-x-auto::-webkit-scrollbar {
        display: none;
    }
    .bestseller-tab-content {
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.bestseller-tab-btn').forEach(btn=>{
        btn.addEventListener('click', function(){
            const tab = this.getAttribute('data-tab');
            document.querySelectorAll('.bestseller-tab-content').forEach(c => c.classList.add('hidden'));
            document.querySelectorAll('.bestseller-tab-btn').forEach(b => b.classList.remove('active'));
            document.getElementById(tab + '-content').classList.remove('hidden');
            this.classList.add('active');
        });
    });
});


document.addEventListener('DOMContentLoaded', () => {

    let hoverIntervals = {};

    // 🔁 Color change
    document.querySelectorAll('input[type="radio"][data-images]').forEach(radio => {
        radio.addEventListener('change', function () {

            const productId = this.dataset.product;
           const images = JSON.parse(this.dataset.images || '[]');
if (!Array.isArray(images) || !images.length) return;

            const img = document.getElementById('product-img-' + productId);

            img.src = images[0];
            img.dataset.images = JSON.stringify(images);
            img.dataset.index = 0;
        });
    });

    // 🖱️ Hover start
    document.querySelectorAll('img[id^="product-img-"]').forEach(img => {

        img.addEventListener('mouseenter', function () {
            const images = JSON.parse(this.dataset.images || '[]');
            if (!images.length) return;

            let index = 0;
            const productId = this.dataset.product;

            hoverIntervals[productId] = setInterval(() => {
                index = (index + 1) % images.length;
                this.src = images[index];
            }, 900);
        });

        // 🛑 Hover end
        img.addEventListener('mouseleave', function () {
            const productId = this.dataset.product;
            clearInterval(hoverIntervals[productId]);

            const images = JSON.parse(this.dataset.images || '[]');
            if (images.length) this.src = images[0];
        });

    });

});




</script>
