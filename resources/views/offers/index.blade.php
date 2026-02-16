@extends('UserView.Home.layout')

@section('title', 'All Exclusive Offers - The Watch')

@section('content')

<!-- Discount Banner -->
<div id="discount-banner" class="fixed top-0 w-screen left-0 right-0 py-3 px-0 text-center z-50 transition-colors duration-500" style="background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%);">
    <div class="flex items-center justify-center gap-3 flex-wrap px-4">
        <span class="text-white font-bold text-sm md:text-base">🎉 Shop All Exclusive Offers 🎉</span>
    </div>
</div>

<!-- Navbar Spacer -->
<div class="h-12 md:h-14"></div>

<!-- Offers Section -->
<section class="w-full py-12 px-4 md:px-6">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8 page-transition">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">All Exclusive Offers</h1>
            <p class="text-gray-600">Discover our complete collection of premium watches on sale</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($cards as $card)
                @include('components.offer-card', ['card' => $card])
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-white/70 text-lg">No offers available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Card JS Script (same as homepage) -->
<script>
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('[id^="card_"]').forEach(function(card){
        const img = card.querySelector('.card-main-img');
        const images = JSON.parse(img.getAttribute('data-images'));
        const dots = card.querySelectorAll('.color-dot');
        const btnPriceEl = card.querySelector('.btn-price');
        const salePriceEl = card.querySelector('.sale-price');
        if(btnPriceEl && salePriceEl) btnPriceEl.textContent = salePriceEl.textContent;

        dots.forEach(function(dot){
            dot.addEventListener('click', function(){
                const idx = parseInt(this.getAttribute('data-index'));
                if(images[idx]) img.src = images[idx];
                dots.forEach(d=>d.classList.remove('ring-2','ring-white'));
                this.classList.add('ring-2','ring-white');
            });
        });

        let hoverInterval = null;
        card.addEventListener('mouseenter', function(){
            let i = 0;
            hoverInterval = setInterval(function(){
                i = (i+1) % images.length;
                img.src = images[i];
            }, 1400);
        });
        card.addEventListener('mouseleave', function(){
            if(hoverInterval) clearInterval(hoverInterval);
        });
    });
});
</script>

@endsection
