<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 gap-4">

        <!-- BUTTON -->
        <a href="{{ route('watches') }}"
           class="group flex flex-col items-center justify-center
           h-28 rounded-2xl text-white
           bg-gradient-to-br from-amber-500 to-black
           hover:scale-105 transition">
            <span class="text-3xl">⌚</span>
            <span class="mt-2 text-sm font-semibold">Watches</span>
        </a>

        <a href="{{ route('headphones') }}"
           class="group flex flex-col items-center justify-center
           h-28 rounded-2xl text-white
           bg-gradient-to-br from-blue-500 to-black
           hover:scale-105 transition">
            <span class="text-3xl">🎧</span>
            <span class="mt-2 text-sm font-semibold">Headphones</span>
        </a>

        <a href="{{ route('airbuds') }}"
           class="group flex flex-col items-center justify-center
           h-28 rounded-2xl text-white
           bg-gradient-to-br from-purple-500 to-black
           hover:scale-105 transition">
            <span class="text-3xl">🎵</span>
            <span class="mt-2 text-sm font-semibold">Airbuds</span>
        </a>

        <a href="{{ route('perfume') }}"
           class="group flex flex-col items-center justify-center
           h-28 rounded-2xl text-white
           bg-gradient-to-br from-pink-500 to-black
           hover:scale-105 transition">
            <span class="text-3xl">🌸</span>
            <span class="mt-2 text-sm font-semibold">Perfumes</span>
        </a>

        <a href="{{ route('wallets') }}"
           class="group flex flex-col items-center justify-center
           h-28 rounded-2xl text-white
           bg-gradient-to-br from-emerald-500 to-black
           hover:scale-105 transition">
            <span class="text-3xl">👛</span>
            <span class="mt-2 text-sm font-semibold">Wallets</span>
        </a>

        <a href="{{ route('toys') }}"
           class="group flex flex-col items-center justify-center
           h-28 rounded-2xl text-white
           bg-gradient-to-br from-red-500 to-black
           hover:scale-105 transition">
            <span class="text-3xl">🧸</span>
            <span class="mt-2 text-sm font-semibold">Toys</span>
        </a>

    </div>
</div>
<!-- ================= PRODUCT SLIDER ================= -->
<div class="relative max-w-6xl mx-auto py-16">

    <!-- LEFT -->
    <button class="slider-btn left-4 prod-prev">❮</button>

    <div class="overflow-hidden prod-wrapper">
        <div class="prod-track">

            <!-- CARD -->
            <a href="{{ route('watches') }}" class="prod-card">
                <img src="{{ asset('Newlaunchimg/watches.png') }}" alt="watches">
                {{-- <div class="overlay">
                    <h3>Luxury Watches</h3>
                    <p>Premium Collection</p>
                </div> --}}
            </a>

            <a href="{{ route('headphones') }}" class="prod-card">
                <img src="{{ asset('Newlaunchimg/headphones.png') }}" alt="headphones">
                {{-- <div class="overlay">
                    <h3>Headphones</h3>
                    <p>Deep Bass Sound</p>
                </div> --}}
            </a>

            <a href="{{ route('airbuds') }}" class="prod-card">
                <img src="{{ asset('Newlaunchimg/airbuds.png') }}" alt="airbuds">
                {{-- <div class="overlay">
                    <h3>Airbuds</h3>
                    <p>Wireless Freedom</p>
                </div> --}}
            </a>
            <a href="{{ route('perfume') }}" class="prod-card">
                <img src="{{ asset('Newlaunchimg/perfumes.png') }}" alt="perfume">
                {{-- <div class="overlay">
                    <h3>Perfumes</h3>
                    <p>Luxgury  Frignance</p>
                </div> --}}
            </a>
<a href="{{ route('wallets') }}" class="prod-card">
                <img src="{{ asset('Newlaunchimg/wallets.png') }}" alt="wallets">
                {{-- <div class="overlay">
                    <h3>Wallets</h3>
                    <p>Customize</p>
                </div> --}}
            </a>
            <a href="{{ route('toys') }}" class="prod-card">
                <img src="{{ asset('Newlaunchimg/toys.png') }}" alt="toys">
                {{-- <div class="overlay">
                    <h3>Toys</h3>
                    <p>Kids Automatic</p>
                </div> --}}
            </a>

        </div>
    </div>

    <!-- RIGHT -->
    <button class="slider-btn right-4 prod-next">❯</button>
</div>


<style>
.prod-wrapper {
    scroll-behavior: smooth;
}

.prod-track {
    display: flex;
    gap: 60px;
    padding: 0 120px;
    align-items: center;
}

.prod-card {
    position: relative;
    min-width: 65%;
    height: 380px;
    border-radius: 18px;
    overflow: hidden;
    background: #000;
    box-shadow: 0 25px 60px rgba(0,0,0,.35);
    transition: transform .4s ease;
}

.prod-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.prod-card:hover {
    transform: scale(1.02);
}

/* Overlay text */
.overlay {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 28px;
    background: linear-gradient(to top, rgba(0,0,0,.7), transparent);
    color: #fff;
}

.overlay h3 {
    font-size: 22px;
    font-weight: 700;
}

.overlay p {
    font-size: 14px;
    opacity: .85;
}

/* Arrows */
.slider-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: rgba(0,0,0,.7);
    color: #fff;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Tablet */
@media (max-width: 1024px) {
    .prod-track {
        padding: 0 80px;
        gap: 40px;
    }
    
    .prod-card {
        min-width: 70%;
        height: 340px;
    }
    
    .slider-btn {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
}

/* Small Tablet / Large Mobile */
@media (max-width: 768px) {
    .prod-track {
        padding: 0 50px;
        gap: 30px;
    }
    
    .prod-card {
        min-width: 85%;
        height: 300px;
    }
    
    .slider-btn {
        width: 36px;
        height: 36px;
        font-size: 14px;
    }
    
    .overlay h3 {
        font-size: 18px;
    }
    
    .overlay p {
        font-size: 12px;
    }
}

/* Mobile */
@media (max-width: 480px) {
    .prod-track {
        padding: 0 30px;
        gap: 20px;
    }
    
    .prod-card {
        min-width: 90%;
        height: 240px;
        border-radius: 12px;
    }
    
    .slider-btn {
        width: 32px;
        height: 32px;
        font-size: 12px;
    }
    
    .overlay {
        padding: 16px;
    }
    
    .overlay h3 {
        font-size: 14px;
    }
    
    .overlay p {
        font-size: 10px;
    }
}

/* Very Small Mobile */
@media (max-width: 360px) {
    .prod-track {
        padding: 0 20px;
        gap: 15px;
    }
    
    .prod-card {
        min-width: 92%;
        height: 200px;
    }
    
    .slider-btn {
        width: 28px;
        height: 28px;
        font-size: 10px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.querySelector('.prod-wrapper');
    const track   = document.querySelector('.prod-track');
    const cards   = document.querySelectorAll('.prod-card');
    const prevBtn = document.querySelector('.prod-prev');
    const nextBtn = document.querySelector('.prod-next');

    const gap = 60;

    const slideAmount = () => cards[0].offsetWidth + gap;

    function updateArrows() {
        const scrollLeft = wrapper.scrollLeft;
        const maxScroll  = track.scrollWidth - wrapper.clientWidth;

        // LEFT arrow
        if (scrollLeft <= 5) {
            prevBtn.style.display = 'none';
        } else {
            prevBtn.style.display = 'flex';
        }

        // RIGHT arrow
        if (scrollLeft >= maxScroll - 5) {
            nextBtn.style.display = 'none';
        } else {
            nextBtn.style.display = 'flex';
        }
    }

    nextBtn.addEventListener('click', () => {
        wrapper.scrollBy({ left: slideAmount(), behavior: 'smooth' });
    });

    prevBtn.addEventListener('click', () => {
        wrapper.scrollBy({ left: -slideAmount(), behavior: 'smooth' });
    });

    wrapper.addEventListener('scroll', updateArrows);
    window.addEventListener('resize', updateArrows);

    // Initial check
    updateArrows();
});
</script>
