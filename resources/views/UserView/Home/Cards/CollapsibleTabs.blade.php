<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl md:text-4xl font-extrabold">Exclusive Collections</h1>
            <p class="text-gray-500">Handpicked Premium Products</p>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('cart') }}" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-full">Cart</a>
        </div>
    </div>

    <!-- Tab Buttons -->
    <div class="flex gap-3 mb-8 flex-wrap">
        <button class="tab-btn active" data-tab="watches-tab">⌚ Watches</button>
        <button class="tab-btn" data-tab="headphones-tab">🎧 Headphones</button>
        <button class="tab-btn" data-tab="airbuds-tab">🎵 Airbuds</button>
    </div>

    @php
        use App\Models\Product;

        // Normalizer for image strings: leave absolute URLs and absolute paths, asset() otherwise
        $normalizeImage = function ($i) {
            if (!is_string($i)) return '';
            if (preg_match('#^https?://#', $i) || str_starts_with($i, '/')) {
                return $i;
            }
            return asset($i);
        };

        if (!isset($watches) || !isset($headphones) || !isset($airbuds)) {
            $watches = Product::where('category', 'watches')->where('active', 1)->get();
            $headphones = Product::where('category', 'headphones')->where('active', 1)->get();
            $airbuds = Product::where('category', 'airbuds')->where('active', 1)->get();
        }

        if (!isset($productImages) || !is_array($productImages)) {
            $all = collect($watches)->concat($headphones)->concat($airbuds);
            $productImages = [];
            foreach ($all as $p) {
                $imgs = $p->images ?: [];
                $imgs = array_map($normalizeImage, $imgs);
                $productImages[$p->id ?? $p->getKey()] = $imgs;
            }
        }
    @endphp

    <!-- Watches Tab -->
   <!-- Watches Tab -->
<div id="watches-tab" class="tab-content block">
    <div class="flex flex-nowrap overflow-x-auto gap-4 py-2 -mx-4 px-4 sm:grid sm:grid-cols-2 lg:grid-cols-3 sm:gap-6 sm:mx-0 sm:px-0">
        @foreach($watches as $p)
        @php $imgs = $productImages[$p->id] ?? []; @endphp
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl p-4 shadow-lg flex-shrink-0 min-w-[250px] sm:min-w-0 sm:flex-shrink-1 product-card">
            <div class="relative">
                <img id="img-{{ $p->id }}" src="{{ $imgs[0] ?? '' }}" alt="{{ $p->name }}" class="w-full h-56 object-cover rounded-lg mb-4 product-image">
                <div class="absolute top-3 right-3 bg-white/10 text-white px-3 py-1 rounded">-{{ $p->discount ?? 0 }}%</div>
            </div>
            <h3 class="text-white font-bold text-lg mb-1">{{ $p->name }}</h3>
            <p class="text-gray-400 mb-3">{{ $p->description ?? 'Premium quality product' }}</p>
            <div class="flex items-center justify-between">
                <div>
                    @if($p->original_price)
                        <div class="text-sm text-gray-500 line-through">Rs {{ number_format($p->original_price) }}</div>
                    @endif
                    <div class="text-2xl font-extrabold text-amber-400">Rs {{ number_format($p->price) }}</div>
                    <div class="text-xs text-gray-400">Incl. taxes</div>
                </div>
                    <div class="flex items-center gap-2">
                        @foreach($p->colors ?? [] as $idx => $c)
                            @php $imgForSwatch = (!empty($imgs) && count($imgs)) ? $imgs[$idx % count($imgs)] : ''; @endphp
                            <button class="color-swatch w-7 h-7 rounded-full border-2 border-white/10 focus:outline-none" 
                                    data-target="#img-{{ $p->id }}" data-img="{{ $imgForSwatch }}" style="background: {{ $c }};"></button>
                        @endforeach
                    </div>
            </div>
            <div class="mt-4 flex gap-2">
                <a href="{{ route('buy', ['type' => 'product', 'id' => $p->id]) }}" class="flex-1 inline-block text-center bg-amber-500 hover:bg-amber-600 text-white py-2 rounded-lg">Buy Now</a>
                <a href="{{ route('watches') }}" class="flex-1 inline-block text-center border border-white/10 text-white py-2 rounded-lg">View More</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

    <!-- Headphones Tab -->
    <div id="headphones-tab" class="tab-content hidden">
        <div class="flex flex-nowrap overflow-x-auto gap-4 py-2 -mx-4 px-4 sm:grid sm:grid-cols-2 lg:grid-cols-3 sm:gap-6 sm:mx-0 sm:px-0">
            @foreach($headphones as $p)
            @php $imgs = $productImages[$p->id] ?? []; @endphp
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl p-4 shadow-lg flex-shrink-0 min-w-[250px] sm:min-w-0 sm:flex-shrink-1 product-card">
                <div class="relative">
                    <img id="img-{{ $p->id }}" src="{{ $imgs[0] ?? '' }}" alt="{{ $p->name }}" class="w-full h-56 object-cover rounded-lg mb-4 product-image">
                    <div class="absolute top-3 right-3 bg-white/10 text-white px-3 py-1 rounded">-{{ $p->discount ?? 0 }}%</div>
                </div>
                <h3 class="text-white font-bold text-lg mb-1">{{ $p->name }}</h3>
                <p class="text-gray-400 mb-3">{{ $p->description ?? 'High-quality audio product' }}</p>
                <div class="flex items-center justify-between">
                    <div>
                        @if($p->original_price)
                            <div class="text-sm text-gray-500 line-through">Rs {{ number_format($p->original_price) }}</div>
                        @endif
                        <div class="text-2xl font-extrabold text-blue-400">Rs {{ number_format($p->price) }}</div>
                        <div class="text-xs text-gray-400">Incl. taxes</div>
                    </div>
                    <div class="flex items-center gap-2">
                        @foreach($p->colors ?? [] as $idx => $c)
                            @php $imgForSwatch = (!empty($imgs) && count($imgs)) ? $imgs[$idx % count($imgs)] : ''; @endphp
                            <button class="color-swatch w-7 h-7 rounded-full border-2 border-white/10 focus:outline-none" 
                                    data-target="#img-{{ $p->id }}" data-img="{{ $imgForSwatch }}" style="background: {{ $c }};"></button>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4 flex gap-2">
                    <a href="{{ route('buy', ['type' => 'product', 'id' => $p->id]) }}" class="flex-1 inline-block text-center bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg">Buy Now</a>
                    <a href="{{ route('headphones') }}"class="flex-1 inline-block text-center border border-white/10 text-white py-2 rounded-lg">View More</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Airbuds Tab -->
    <div id="airbuds-tab" class="tab-content hidden">
        <div class="flex flex-nowrap overflow-x-auto gap-4 py-2 -mx-4 px-4 sm:grid sm:grid-cols-2 lg:grid-cols-3 sm:gap-6 sm:mx-0 sm:px-0">
            @foreach($airbuds as $p)
            @php $imgs = $productImages[$p->id] ?? []; @endphp
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl p-4 shadow-lg flex-shrink-0 min-w-[250px] sm:min-w-0 sm:flex-shrink-1    product-card">
                <div class="relative">
                    <img id="img-{{ $p->id }}" src="{{ $imgs[0] ?? '' }}" alt="{{ $p->name }}" class="w-full h-56 object-cover rounded-lg mb-4 product-image">
                    <div class="absolute top-3 right-3 bg-white/10 text-white px-3 py-1 rounded">-{{ $p->discount ?? 0 }}%</div>
                </div>
                <h3 class="text-white font-bold text-lg mb-1">{{ $p->name }}</h3>
                <p class="text-gray-400 mb-3">{{ $p->description ?? 'Premium wireless audio' }}</p>
                <div class="flex items-center justify-between">
                    <div>
                        @if($p->original_price)
                            <div class="text-sm text-gray-500 line-through">Rs {{ number_format($p->original_price) }}</div>
                        @endif
                        <div class="text-2xl font-extrabold text-purple-400">Rs {{ number_format($p->price) }}</div>
                        <div class="text-xs text-gray-400">Incl. taxes</div>
                    </div>
                    <div class="flex items-center gap-2">
                        @foreach($p->colors ?? [] as $idx => $c)
                            @php $imgForSwatch = (!empty($imgs) && count($imgs)) ? $imgs[$idx % count($imgs)] : ''; @endphp
                            <button class="color-swatch w-7 h-7 rounded-full border-2 border-white/10 focus:outline-none" 
                                    data-target="#img-{{ $p->id }}" data-img="{{ $imgForSwatch }}" style="background: {{ $c }};"></button>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4 flex gap-2">
                    <a href="{{ route('buy', ['type' => 'product', 'id' => $p->id]) }}" class="flex-1 inline-block text-center bg-purple-500 hover:bg-purple-600 text-white py-2 rounded-lg">Buy Now</a>
                    <a href="{{ route('airbuds') }}" class="flex-1 inline-block text-center border border-white/10 text-white py-2 rounded-lg">View More</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
.tab-btn {
    padding: 0.6rem 1.4rem;
    border-radius: 9999px;
    border: 1px solid #666;
    font-weight: 600;
    color: #fff;
    background: #1f2937;
    cursor: pointer;
    transition: all 0.3s ease;
}
.tab-btn:hover {
    background: #374151;
}
.tab-btn.active {
    background: #f59e0b;
    color: #fff;
    border-color: #f59e0b;
}

.product-card {
    transition: transform 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
}

.product-image {
    transition: opacity 0.4s ease;
}

.product-image.changing {
    opacity: 0.5;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
    // productImages map provided by controller (asset-ified)
    const productImages = @json($productImages ?? []);

    // Color swatch functionality
    document.querySelectorAll('.color-swatch').forEach(btn => {
        btn.addEventListener('click', function(){
            const target = document.querySelector(this.getAttribute('data-target'));
            const img = this.getAttribute('data-img');
            if (target) target.src = img;

            // visual active state
            const group = this.parentElement;
            group.querySelectorAll('.color-swatch').forEach(s => s.classList.remove('ring-2', 'ring-white'));
            this.classList.add('ring-2', 'ring-white');
        });
    });

    // Hover image change functionality
    document.querySelectorAll('.product-card').forEach(card => {
        const img = card.querySelector('.product-image');
        const productId = img.id.replace('img-', '');
        const images = productImages[productId] || [];
        let hoverInterval;

        card.addEventListener('mouseenter', function(){
            if(images.length < 2) return;
            
            // Random number of image changes (2-5)
            const changeCount = Math.floor(Math.random() * 4) + 2;
            let changes = 0;
            
            hoverInterval = setInterval(() => {
                if(changes >= changeCount) {
                    clearInterval(hoverInterval);
                    return;
                }
                
                // Random image from available images
                const randomImg = images[Math.floor(Math.random() * images.length)];
                img.classList.add('changing');
                
                setTimeout(() => {
                    img.src = randomImg;
                    img.classList.remove('changing');
                }, 200);
                
                changes++;
            }, 300);
        });

        card.addEventListener('mouseleave', function(){
            clearInterval(hoverInterval);
            // Reset to first image
            img.src = images[0];
        });
    });

    // Tab switching functionality
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function(){
            const tabName = this.getAttribute('data-tab');
            
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Remove active class from all buttons
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('active');
            });
            
            // Show selected tab content
            document.getElementById(tabName).classList.remove('hidden');
            
            // Add active class to clicked button
            this.classList.add('active');
        });
    });
});
</script>
