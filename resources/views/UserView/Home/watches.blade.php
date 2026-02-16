@extends('UserView.Home.layout')

@section('title', 'Premium Watches - The Watch')

@section('content')

<div class="bg-gradient-to-r from-amber-600 to-orange-600 py-6">
    <div class="max-w-7xl mx-auto px-4">
        <span class="text-white font-bold text-sm md:text-base">
            ⌚ Explore Our Complete Watches Collection ⌚
        </span>
    </div>
</div>

@php
    use App\Models\Product;
    if (!isset($products)) {
        $products = Product::where('category', 'watches')
            ->where('active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(48);
    }
@endphp

<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-12">

        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">
                Premium Watches Collection
            </h1>
            <p class="text-gray-600 text-lg">
                Discover our extensive range of luxury timepieces
            </p>
        </div>

        <!-- Filter Buttons -->
        <div class="mb-8 flex gap-4">
            <button id="menBtn"
                class="px-8 py-3 bg-amber-600 text-white font-semibold rounded-lg transition-all"
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
                    $image = null;
                    // resolve image URL helper
                    $resolveImageUrl = function($img) {
                        $img = trim((string) $img);
                        if ($img === '') return null;
                        $img = str_replace('\\', '/', $img);
                        if (str_starts_with($img, 'http')) return $img;
                        $clean = ltrim($img, '/');
                        if (str_starts_with($clean, 'storage/')) {
                            $sub = preg_replace('#^storage/#', '', $clean);
                            if (file_exists(storage_path('app/public/' . $sub))) return asset('storage/' . $sub);
                            if (file_exists(public_path($clean))) return asset($clean);
                            return asset('storage/' . $sub);
                        }
                        if (file_exists(public_path($clean))) return asset($clean);
                        if (file_exists(storage_path('app/public/' . $clean))) return asset('storage/' . $clean);
                        return asset($clean);
                    };

                    // build flattened lists and resolved URLs
                    $imagesForJs = [];
                    $imagesForJsUrls = [];
                    if (!empty($product->images) && is_array($product->images)) {
                        if (array_is_list($product->images)) {
                            foreach ($product->images as $pimg) {
                                $pimg = str_replace('\\', '/', $pimg);
                                $imagesForJs[] = $pimg;
                                $u = $resolveImageUrl($pimg);
                                if ($u) $imagesForJsUrls[] = $u;
                            }
                            $image = $imagesForJs[0] ?? null;
                        } else {
                            foreach ($product->images as $v) {
                                if (is_array($v)) {
                                    foreach ($v as $x) {
                                        $x = str_replace('\\', '/', $x);
                                        $imagesForJs[] = $x;
                                        $u = $resolveImageUrl($x);
                                        if ($u) $imagesForJsUrls[] = $u;
                                    }
                                } else {
                                    $v = str_replace('\\', '/', $v);
                                    $imagesForJs[] = $v;
                                    $u = $resolveImageUrl($v);
                                    if ($u) $imagesForJsUrls[] = $u;
                                }
                            }
                            $firstColor = array_key_first($product->images);
                            $first = $product->images[$firstColor][0] ?? null;
                            $image = $first ? str_replace('\\', '/', $first) : ($imagesForJs[0] ?? null);
                        }
                    }

                    $src = asset('images/no-image.png');
                    if ($image) {
                        $maybe = $resolveImageUrl($image);
                        if ($maybe) $src = $maybe;
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
                            src="{{ $src }}"
                            loading="lazy"
                            data-images='@json($imagesForJsUrls ?? [])'
                            data-index="0"
                            data-product="{{ $product->id }}"
                            class="w-full h-full object-cover cursor-pointer"
                        />

                        <div class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">
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
                                Rs {{ number_format($product->sale_price ?? 0) }}
                            </span>
                            <span class="text-sm text-gray-500 line-through ml-2">
                                Rs {{ number_format($product->orig_price ?? 0) }}
                            </span>
                        </div>

                        @if(!empty($product->colors) && is_array($product->colors))
                            <div class="flex gap-2 mt-2">
                                @php
                                    $colorKeys = array_keys($product->colors ?? []);
                                    $allImagesFlat = [];
                                    $allImagesFlatUrls = [];
                                    if (!empty($product->images) && is_array($product->images)) {
                                        foreach ($product->images as $v) {
                                            if (is_array($v)) {
                                                foreach ($v as $x) {
                                                    $x = str_replace('\\', '/', $x);
                                                    $allImagesFlat[] = $x;
                                                    $u = $resolveImageUrl($x);
                                                    if ($u) $allImagesFlatUrls[] = $u;
                                                }
                                            } else {
                                                $v = str_replace('\\', '/', $v);
                                                $allImagesFlat[] = $v;
                                                $u = $resolveImageUrl($v);
                                                if ($u) $allImagesFlatUrls[] = $u;
                                            }
                                        }
                                    }
                                @endphp
                                @foreach($product->colors as $colorName => $colorCode)
                                    <label class="cursor-pointer">
                                        @php
                                            $perColor = $product->images[$colorName] ?? [];
                                            $perColorUrls = [];
                                            if (is_array($perColor)) {
                                                foreach ($perColor as $pi) {
                                                    $pi = str_replace('\\', '/', $pi);
                                                    $u = $resolveImageUrl($pi);
                                                    if ($u) $perColorUrls[] = $u;
                                                }
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
                            <a href="{{ route('buy', ['type' => 'watches', 'id' => $product->id]) }}" class="flex-1 inline-block text-center bg-amber-600 hover:bg-amber-700 text-white py-2 rounded-lg">Buy Now</a>
                            <a href="{{ route('watches') }}" class="flex-1 inline-block text-center border border-gray-200 text-gray-700 py-2 rounded-lg">View More</a>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-20">
                    <img src="{{ asset('LOGO/The-watch-logo.svg') }}" alt="Coming Soon" class="w-28 h-28 mb-6 opacity-90">
                    <h3 class="text-3xl font-extrabold text-gray-900 mb-2">Coming Soon</h3>
                    <p class="text-gray-600 mb-6 max-w-2xl text-center">We're working on bringing a premium watches collection to our store. Sign up for updates or explore our other categories meanwhile.</p>
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
        menBtn.classList.toggle('bg-amber-600', activeGender === 'men');
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
        window.location.href = '{{ route("watches") }}?gender=men';
    });

    womenBtn.addEventListener('click', () => {
        window.location.href = '{{ route("watches") }}?gender=women';
    });

    allBtn.addEventListener('click', () => {
        window.location.href = '{{ route("watches") }}';
    });

    // Safe image setter with fallback
    const defaultPlaceholder = '{{ asset("images/no-image.png") }}';
    function trySetImage(img, url, fallbackList) {
        if (!img) return;
        img.onerror = function () {
            if (Array.isArray(fallbackList) && fallbackList.length) {
                img.onerror = null;
                img.src = fallbackList[0] || defaultPlaceholder;
                img.dataset.images = JSON.stringify(fallbackList);
                img.dataset.index = 0;
            } else {
                img.onerror = null;
                img.src = defaultPlaceholder;
                img.dataset.images = JSON.stringify([]);
                img.dataset.index = 0;
            }
        };
        img.src = url || (Array.isArray(fallbackList) && fallbackList[0]) || defaultPlaceholder;
    }

    // Color change handler
    document.querySelectorAll('input[type="radio"][data-images]').forEach(radio => {
        radio.addEventListener('change', function () {
            const productId = this.dataset.product;
            const images = JSON.parse(this.dataset.images || '[]');
            const allImages = JSON.parse(this.dataset.allImages || '[]');
            const colorKeys = JSON.parse(this.dataset.colorsKeys || '[]');

            const img = document.getElementById('product-img-' + productId);
            if (!img) return;

            // If this color has its own images array, use that
            if (Array.isArray(images) && images.length) {
                trySetImage(img, images[0], images);
                img.dataset.images = JSON.stringify(images);
                img.dataset.index = 0;
                return;
            }

            // Fallback: map color to last-N images if possible
            if (Array.isArray(allImages) && allImages.length && Array.isArray(colorKeys) && colorKeys.length) {
                const color = this.dataset.color;
                const idx = colorKeys.indexOf(color);
                const colorCount = colorKeys.length;
                let mapIndex = 0;
                if (allImages.length >= colorCount) {
                    mapIndex = (allImages.length - colorCount) + (idx >= 0 ? idx : 0);
                } else {
                    mapIndex = (idx >= 0 ? idx : 0) % allImages.length;
                }
                const chosen = allImages[mapIndex % allImages.length];
                trySetImage(img, chosen, allImages);
                img.dataset.images = JSON.stringify(allImages);
                img.dataset.index = mapIndex % allImages.length;
                return;
            }

            // otherwise nothing to change
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
