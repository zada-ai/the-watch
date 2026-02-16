@extends('UserView.Home.layout')

@section('title', 'Premium Airbuds - The Watch')

@section('content')

<div class="bg-gradient-to-r from-purple-600 to-pink-600 py-6">
    <div class="max-w-7xl mx-auto px-4">
        <span class="text-white font-bold text-sm md:text-base">🎵 Explore Our Complete Airbuds Collection 🎵</span>
    </div>
</div>

@php
    use App\Models\Product;
    if (!isset($products)) {
        $products = Product::where('category', 'airbuds')
            ->where('active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(24);
    }
@endphp

<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-12">

        <!-- Page Header -->
        <div class="mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">Premium Airbuds Collection</h1>
            <p class="text-gray-600 text-lg">Wireless freedom with superior sound quality and comfort</p>
        </div>

        <!-- Filter Buttons -->
        <div class="mb-8 flex gap-4">
            <button id="menBtn"
                class="px-8 py-3 bg-purple-600 text-white font-semibold rounded-lg transition-all"
                data-gender="men">
                ♂️ Men
            </button>
            <button id="womenBtn"
                class="px-8 py-3 bg-gray-300 text-gray-700 font-semibold rounded-lg transition-all"
                data-gender="women">
                ♀️ Women
            </button>
            <button id="allBtn"
                class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg transition-all"
                data-gender="all">
                All
            </button>
        </div>

        <!-- Products Grid -->
        <!-- Mobile: slider | Desktop: grid -->
<div class="
    flex md:grid
    flex-nowrap md:flex-wrap
    overflow-x-auto md:overflow-visible
    gap-3 md:gap-6
    md:grid-cols-3 lg:grid-cols-4
    pb-4
    snap-x snap-mandatory
">

            @forelse($products as $product)
                @php
                    // Build resolved image URLs for JS and initial src
                    $allImages = [];
                    $imagesRaw = $product->images ?? [];
                    if (is_array($imagesRaw) && count($imagesRaw)) {
                        // If images keyed by color (assoc), flatten to a list preserving order
                        foreach ($imagesRaw as $k => $v) {
                            if (is_array($v)) {
                                foreach ($v as $it) $allImages[] = $it;
                            } else {
                                $allImages[] = $v;
                            }
                        }
                    }

                    $resolve = function($image) {
                        if (empty($image)) return null;
                        if (str_starts_with($image, 'http')) return $image;
                        if (file_exists(public_path($image))) return asset($image);
                        if (str_starts_with($image, '/storage/') || str_starts_with($image, 'storage/')) {
                            $clean = preg_replace('#^/storage/#', '', $image);
                            $clean = preg_replace('#^storage/#', '', $clean);
                            if (file_exists(storage_path('app/public/' . $clean))) return asset('storage/' . $clean);
                            return asset($clean);
                        }
                        if (str_contains($image, 'best-seller-assets')) {
                            if (file_exists(public_path($image))) return asset($image);
                            if (file_exists(storage_path('app/public/' . ltrim($image, '/')))) return asset('storage/' . ltrim($image, '/'));
                            return asset(ltrim($image, '/'));
                        }
                        if (file_exists(storage_path('app/public/' . ltrim($image, '/')))) return asset('storage/' . ltrim($image, '/'));
                        return asset(ltrim($image, '/'));
                    };

                    $imagesForJs = array_values(array_filter(array_map($resolve, $allImages)));
                    $firstSrc = asset('images/no-image.png');
                    if (!empty($imagesForJs)) $firstSrc = $imagesForJs[0];

                    // Build per-color resolved arrays
                    $perColor = [];
                    $allImagesFlat = [];
                    $allImagesFlatUrls = [];
                    if (is_array($product->images)) {
                        foreach ($product->images as $k => $v) {
                            if (is_array($v)) {
                                $perColor[$k] = array_values(array_filter(array_map($resolve, $v)));
                                foreach ($v as $x) {
                                    $x = str_replace('\\', '/', $x);
                                    $allImagesFlat[] = $x;
                                    $u = $resolve($x);
                                    if ($u) $allImagesFlatUrls[] = $u;
                                }
                            } else {
                                $perColor[$k] = array_values(array_filter([$resolve($v)]));
                                $vv = str_replace('\\', '/', $v);
                                $allImagesFlat[] = $vv;
                                $u = $resolve($vv);
                                if ($u) $allImagesFlatUrls[] = $u;
                            }
                        }
                    }

                    // compute sale price
                    $rawPrice = $product->price ?? 0;
                    $discount = $product->discount ?? 0;
                    $salePrice = $rawPrice;
                    if ($rawPrice && $discount) {
                        $salePrice = round($rawPrice - ($rawPrice * ($discount/100)));
                    }
                @endphp

               <div class="
    bg-white rounded-xl shadow
    hover:shadow-2xl hover:-translate-y-2
    transition-all duration-300 overflow-hidden
    min-w-[48%] sm:min-w-[45%] md:min-w-0
    snap-start
">

                   <div class="relative h-40 sm:h-48 md:h-64 bg-gray-100 overflow-hidden">

                        <img
                            id="product-img-{{ $product->id }}"
                            src="{{ $firstSrc }}"
                            loading="lazy"
                            data-images='@json($imagesForJs)'
                            data-index="0"
                            data-product="{{ $product->id }}"
                            class="w-full h-full object-cover cursor-pointer"
                        />

                        <div class="absolute top-2 right-2 bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                            -{{ $product->discount ?? 0 }}%
                        </div>
                    </div>

                   <div class="p-2 sm:p-3 md:p-4">

                        <h3 class="text-lg font-semibold text-gray-900 mb-2 truncate">
                            {{ $product->name }}
                        </h3>

                        <p class="text-sm text-gray-500 mb-2 truncate">{{ $product->descri ?? '' }}</p>

                        <div class="mb-3">
                            <span class="text-2xl font-bold text-gray-900">
                                Rs {{ number_format($salePrice ?? 0) }}
                            </span>
                            <span class="text-sm text-gray-500 line-through ml-2">
                                Rs {{ number_format($product->orig_price ?? ($rawPrice ?? 0)) }}
                            </span>
                        </div>

                        @if(!empty($product->colors) && is_array($product->colors))
                            <div class="flex gap-2 mt-2">
                                @php $colorKeys = array_keys($product->colors ?? []); @endphp
                                @foreach($product->colors as $colorName => $colorCode)
                                    <label class="cursor-pointer">
                                        @php
                                            $perColorUrls = [];
                                            $maybe = $product->images[$colorName] ?? [];
                                            if (is_array($maybe)) {
                                                foreach ($maybe as $pi) {
                                                    $pi = str_replace('\\', '/', $pi);
                                                    $u = $resolve($pi);
                                                    if ($u) $perColorUrls[] = $u;
                                                }
                                            } else {
                                                $pi = str_replace('\\', '/', $maybe);
                                                $u = $resolve($pi);
                                                if ($u) $perColorUrls = array_filter([$u]);
                                            }
                                        @endphp
                                        <input
                                            type="radio"
                                            name="color_{{ $product->id }}"
                                            class="sr-only"
                                            data-product="{{ $product->id }}"
                                            data-color="{{ $colorName }}"
                                            data-images='@json($perColorUrls)'
                                            data-all-images='@json($allImagesFlatUrls)'
                                            data-colors-keys='@json($colorKeys)'
                                        >
                                        <span
                                            title="{{ ucfirst($colorName) }}"
                                            class="w-6 h-6 rounded-full border border-gray-300 inline-block"
                                            style="background-color: {{ $colorCode }}"
                                        ></span>
                                    </label>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('buy', ['type' => 'airbuds', 'id' => $product->id]) }}" class="flex-1 inline-block text-center bg-purple-600 hover:bg-purple-700 text-white py-2 rounded-lg">Buy Now</a>
                            <a href="{{ route('airbuds') }}" class="flex-1 inline-block text-center border border-gray-200 text-gray-700 py-2 rounded-lg">View More</a>
                        </div>
                    </div>
                </div>

            @empty
                   <div class="col-span-full flex flex-col items-center justify-center py-20">
                    <img src="{{ asset('LOGO/The-watch-logo.svg') }}" alt="Coming Soon" class="w-28 h-28 mb-6 opacity-90">
                    <h3 class="text-3xl font-extrabold text-gray-900 mb-2">Coming Soon</h3>
                    <p class="text-gray-600 mb-6 max-w-2xl text-center">We're working on bringing a premium Airbuds collection to our store. Sign up for updates or explore our other categories meanwhile.</p>
                    <div class="flex gap-3">
                        <a href="{{ route('user.home') }}" class="inline-block bg-amber-600 text-white px-6 py-2 rounded-full shadow">Browse Home</a>
                        <a href="{{ route('Support') }}" class="inline-block border border-gray-300 text-gray-700 px-6 py-2 rounded-full">Contact Support</a>
                    </div>
                </div>
            @endforelse

        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>

    </div>
</div>
<style>
/* Hide scrollbar for mobile slider */
@media (max-width: 768px) {
  .overflow-x-auto::-webkit-scrollbar {
    display: none;
  }
}
</style>

<!-- Best-seller style JS: color change + hover cycling + gender filter -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    let hoverIntervals = {};

    // Gender filter buttons
    const menBtn = document.getElementById('menBtn');
    const womenBtn = document.getElementById('womenBtn');
    const allBtn = document.getElementById('allBtn');

    function updateButtonStyles(activeGender) {
        menBtn.classList.toggle('bg-purple-600', activeGender === 'men');
        menBtn.classList.toggle('text-white', activeGender === 'men');
        menBtn.classList.toggle('bg-gray-300', activeGender !== 'men');
        menBtn.classList.toggle('text-gray-700', activeGender !== 'men');

        womenBtn.classList.toggle('bg-pink-600', activeGender === 'women');
        womenBtn.classList.toggle('text-white', activeGender === 'women');
        womenBtn.classList.toggle('bg-gray-300', activeGender !== 'women');
        womenBtn.classList.toggle('text-gray-700', activeGender !== 'women');

        allBtn.classList.toggle('bg-blue-600', activeGender === 'all');
        allBtn.classList.toggle('text-white', activeGender === 'all');
        allBtn.classList.toggle('bg-gray-300', activeGender !== 'all');
        allBtn.classList.toggle('text-gray-700', activeGender !== 'all');
    }

    // Check current URL to highlight correct button
    const urlParams = new URLSearchParams(window.location.search);
    const currentGender = urlParams.get('gender') || 'all';
    updateButtonStyles(currentGender);

    menBtn.addEventListener('click', () => {
        window.location.href = '{{ route("airbuds") }}?gender=men';
    });

    womenBtn.addEventListener('click', () => {
        window.location.href = '{{ route("airbuds") }}?gender=women';
    });

    allBtn.addEventListener('click', () => {
        window.location.href = '{{ route("airbuds") }}';
    });

    // Color change handler
    document.querySelectorAll('input[type="radio"][data-product]').forEach(radio => {
        radio.addEventListener('change', function () {
            const productId = this.dataset.product;
            const perColorImages = JSON.parse(this.dataset.images || '[]');
            const allImages = JSON.parse(this.getAttribute('data-all-images') || '[]');
            const colorKeys = JSON.parse(this.getAttribute('data-colors-keys') || '[]');
            const colorName = this.dataset.color;

            const img = document.getElementById('product-img-' + productId);
            if (!img) return;

            // Use per-color images if available, otherwise fallback to mapping
            if (perColorImages && perColorImages.length) {
                img.src = perColorImages[0];
                img.dataset.images = JSON.stringify(perColorImages);
            } else if (allImages && allImages.length && colorKeys.length) {
                // Map color index to image index
                const colorIdx = colorKeys.indexOf(colorName);
                const imgIdx = colorIdx >= 0 ? colorIdx % allImages.length : 0;
                img.src = allImages[imgIdx];
                img.dataset.images = JSON.stringify(allImages);
            }
            img.dataset.index = 0;
        });
    });

    // Hover start
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

        img.addEventListener('mouseleave', function () {
            const productId = this.dataset.product;
            clearInterval(hoverIntervals[productId]);

            const images = JSON.parse(this.dataset.images || '[]');
            if (images.length) this.src = images[0];
        });

    });
});
</script>

@endsection
