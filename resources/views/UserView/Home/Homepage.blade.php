@extends('UserView.Home.layout')

@section('title', 'Home - The Watch')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Discount Banner -->
   

    <!-- Navbar Spacer (discount banner height only) -->
   

    <!-- Hero Section with Image Pagination -->
    <div class="relative w-full h-[400px] xs:h-[450px] sm:h-[550px] md:h-[600px] lg:h-[700px] flex items-center justify-center overflow-hidden bg-gray-900">
        
        <!-- Image Container (Carousel) -->
        <div class="absolute inset-0 w-full h-full">
            <div id="carousel" class="relative w-full h-full">
                <!-- Slide 1 -->
                <div class="carousel-slide absolute inset-0 w-full h-full bg-cover bg-center bg-no-repeat opacity-100 transition-opacity duration-1000" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('Landingpaginationimg/desktop_9.jfif') }}');"></div>
                
                <!-- Slide 2 -->
                <div class="carousel-slide absolute inset-0 w-full h-full bg-cover bg-center bg-no-repeat opacity-0 transition-opacity duration-1000" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('Landingpaginationimg/desktop_4.jfif') }}');"></div>
                
                <!-- Slide 3 -->
                <div class="carousel-slide absolute inset-0 w-full h-full bg-cover bg-center bg-no-repeat opacity-0 transition-opacity duration-1000" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('Landingpaginationimg/Aura.jpg') }}');"></div>
                
                <!-- Slide 4 -->
                <div class="carousel-slide absolute inset-0 w-full h-full bg-cover bg-center bg-no-repeat opacity-0 transition-opacity duration-1000" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('Landingpaginationimg/zenioth_desktop_copy_196c8dd4-b3de-435b-8f3a-fd92bfe07b45.jfif') }}');"></div>
                
                <!-- Slide 5 -->
                <div class="carousel-slide absolute inset-0 w-full h-full bg-cover bg-center bg-no-repeat opacity-0 transition-opacity duration-1000" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('Landingpaginationimg/year-end-banner_1.jfif') }}');"></div>
            </div>
        </div>

        <!-- Hero Content with Left-Right Split -->
        <div class="absolute inset-0 flex items-center z-10 px-3 xs:px-4 sm:px-6 md:px-8 lg:px-12">
    
    <!-- LEFT: Text Content -->
    <div class="w-full md:w-1/2 text-left">
        
        <h1 class="text-base xs:text-lg sm:text-2xl md:text-4xl lg:text-5xl xl:text-6xl 
                   font-bold mb-2 sm:mb-3 md:mb-4 
                   text-white leading-tight">
            Time That Defines<br> Your Style
        </h1>

        <p class="text-xs xs:text-xs sm:text-sm md:text-lg lg:text-xl 
                  mb-3 sm:mb-4 md:mb-6 
                  text-gray-300">
            Handcrafted watches designed for those
            <br>
            who value precision, class, and confidence.
        </p>

        <a href="#get-started"
           class="inline-block 
                  bg-white text-black
                  px-3 xs:px-4 sm:px-5 md:px-6 lg:px-8
                  py-1.5 xs:py-2 sm:py-2.5 md:py-3
                  rounded-full font-semibold
                  hover:bg-gray-200 transition
                  text-xs xs:text-sm sm:text-base md:text-lg">
            Explore Collection
        </a>

    </div>
            
            <!-- RIGHT: Featured Product Visual -->
          <div class="hidden md:flex w-1/2 items-center justify-end pr-8">
                <div class="relative w-64 h-64 flex items-center justify-center">
                    <!-- Decorative Circle Background -->
                    <div class="absolute w-80 h-80 rounded-full bg-gradient-to-br from-amber-500/10 to-amber-900/10 blur-3xl"></div>
                    <!-- Watch Icon/Image -->
                    {{-- <div class="relative z-10 flex items-center justify-center">
                        <img src="{{ asset('LOGO/The-watch-logo.svg') }}"
                             alt="Featured Watch"
                             class="w-48 h-48 object-contain filter brightness-125 drop-shadow-2xl hover:scale-110 transition-transform duration-500" />
                    </div> --}}
                </div>
            </div>
        </div>


        <!-- Pagination Dots -->
        <div class="hidden md:flex absolute bottom-4 xs:bottom-6 sm:bottom-8 md:bottom-8 left-1/2 transform -translate-x-1/2 gap-2 xs:gap-3 z-10">
            <button class="pagination-dot w-2 h-2 xs:w-3 xs:h-3 rounded-full bg-white opacity-100 cursor-pointer transition" data-index="0"></button>
            <button class="pagination-dot w-2 h-2 xs:w-3 xs:h-3 rounded-full bg-white opacity-50 cursor-pointer transition" data-index="1"></button>
            <button class="pagination-dot w-2 h-2 xs:w-3 xs:h-3 rounded-full bg-white opacity-50 cursor-pointer transition" data-index="2"></button>
            <button class="pagination-dot w-2 h-2 xs:w-3 xs:h-3 rounded-full bg-white opacity-50 cursor-pointer transition" data-index="3"></button>
            <button class="pagination-dot w-2 h-2 xs:w-3 xs:h-3 rounded-full bg-white opacity-50 cursor-pointer transition" data-index="4"></button>
        </div>

        <!-- Decorative overlay for image visibility -->
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-gray-900 pointer-events-none"></div>
    </div>

    <!-- Hero Section Logos/Badges (below landing section) -->
    @include('UserView.Home.Herosection.Herosection')
    @include('UserView.Home.Cards.CollapsibleTabs')
    @include('UserView.Home.Cards.Best-seller')
    @include('UserView.Home.Cards.New-launch')
    <!-- Take Your Order Section (Contact capture) -->
    <section id="get-started" class="w-full py-10 xs:py-12 sm:py-14 md:py-16 px-3 xs:px-4 sm:px-6 md:px-8 bg-gradient-to-br from-gray-800 to-gray-900">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-2xl xs:text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-3">Take Your Order</h2>
            <p class="text-gray-300 mb-6">Leave your contact and we'll get back to you to complete the order — choose email or phone.</p>

            <form id="takeOrderForm" class="flex flex-col sm:flex-row items-center gap-3 justify-center">
                <label class="sr-only" for="contactEmail">Email</label>
                <input id="contactEmail" type="email" placeholder="Email (example@you.com)" class="w-full sm:w-1/2 px-4 py-3 rounded-full bg-white text-black placeholder-gray-500 focus:outline-none" />

                <label class="sr-only" for="contactPhone">Phone</label>
                <input id="contactPhone" type="tel" placeholder="Phone (0300-1234567)" class="w-full sm:w-1/2 px-4 py-3 rounded-full bg-white text-black placeholder-gray-500 focus:outline-none" />

                <button type="submit" class="mt-3 sm:mt-0 sm:ml-3 bg-amber-500 hover:bg-amber-600 text-white px-6 py-3 rounded-full font-semibold">Send</button>
            </form>

            <p id="takeOrderMsg" class="mt-4 text-sm text-amber-300 hidden"></p>
        </div>
    </section>

    <!-- Success Modal (hidden by default) -->
    <div id="orderSuccessModal" class="hidden fixed inset-0 bg-black/60 items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-900 rounded-xl max-w-md w-full mx-4 p-6 text-center shadow-2xl">
            <button class="modal-close-btn absolute top-4 right-4 text-gray-700 hover:text-gray-900" aria-label="Close" onclick="closeOrderModal()">✕</button>
            <div class="py-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Thank you!</h3>
                <p class="text-gray-700 dark:text-gray-300">Company will contact you within 24 hours.</p>
            </div>
            <div class="mt-4">
                <button onclick="closeOrderModal()" class="bg-amber-500 hover:bg-amber-600 text-white px-5 py-2 rounded-full font-semibold">OK</button>
            </div>
        </div>
    </div>

    <!-- Customer Reviews Section -->
   <section class="w-full py-12 px-4 sm:px-6 md:px-8 bg-gray-900">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white mb-2">⭐ Customer Love Stories</h2>
            <p class="text-gray-400 text-sm sm:text-base max-w-2xl mx-auto">See what our happy customers say about their purchases</p>
        </div>

        <!-- Reviews Carousel -->
       <div class="overflow-x-auto no-scrollbar scroll-smooth">
    <div id="reviewsContainer" class="flex gap-6 w-max px-1">

        <!-- Default Reviews -->
        <div id="defaultReviews" class="flex gap-6">

            <!-- Review Card 1 -->
            <div class="min-w-[85%] sm:min-w-[45%] md:min-w-[32%] bg-gray-800/60 border border-gray-700 rounded-xl p-5 flex-shrink-0
                        hover:border-amber-400/50 hover:scale-[1.03] transition-all duration-300 hover:bg-gray-800/80">
                
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-full overflow-hidden ring-1 ring-gray-600">
                        <img src="https://via.placeholder.com/48" alt="Ahmed Raza" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="text-white text-sm font-semibold">Ahmed Raza</h4>
                        <p class="text-gray-400 text-xs">Verified Buyer ✓</p>
                    </div>
                </div>

                <div class="flex text-amber-400 gap-0.5 mb-3 text-sm">
                    ★★★★★
                </div>

                <p class="text-gray-100 text-sm mb-3 leading-relaxed">
                    "Amazing quality! The watch arrived perfectly on time and looks even better than the pictures."
                </p>

                <p class="text-gray-400 text-xs">
                    Purchased: Premium Watch Model A • 2 weeks ago
                </p>
            </div>

            <!-- Review Card 2 -->
            <div class="min-w-[85%] sm:min-w-[45%] md:min-w-[32%] bg-gray-800/60 border border-gray-700 rounded-xl p-5 flex-shrink-0
                        hover:border-blue-400/50 hover:scale-[1.03] transition-all duration-300 hover:bg-gray-800/80">
                
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-full overflow-hidden ring-1 ring-gray-600">
                        <img src="https://via.placeholder.com/48" alt="Fatima Hassan" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="text-white text-sm font-semibold">Fatima Hassan</h4>
                        <p class="text-gray-400 text-xs">Verified Buyer ✓</p>
                    </div>
                </div>

                <div class="flex text-amber-400 gap-0.5 mb-3 text-sm">
                    ★★★★★
                </div>

                <p class="text-gray-100 text-sm mb-3 leading-relaxed">
                    "Best headphones ever! Noise cancellation is insane and sound quality is crystal clear."
                </p>

                <p class="text-gray-400 text-xs">
                    Purchased: Premium Headphones • 1 month ago
                </p>
            </div>

            <!-- Review Card 3 -->
            <div class="min-w-[85%] sm:min-w-[45%] md:min-w-[32%] bg-gray-800/60 border border-gray-700 rounded-xl p-5 flex-shrink-0
                        hover:border-purple-400/50 hover:scale-[1.03] transition-all duration-300 hover:bg-gray-800/80">
                
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-full overflow-hidden ring-1 ring-gray-600">
                        <img src="https://via.placeholder.com/48" alt="Muhammad Khan" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="text-white text-sm font-semibold">Muhammad Khan</h4>
                        <p class="text-gray-400 text-xs">Verified Buyer ✓</p>
                    </div>
                </div>

                <div class="flex text-amber-400 gap-0.5 mb-3 text-sm">
                    ★★★★★
                </div>

                <p class="text-gray-100 text-sm mb-3 leading-relaxed">
                    "Airbuds are perfect for gym use. Battery life is excellent and fitting is solid."
                </p>

                <p class="text-gray-400 text-xs">
                    Purchased: Airbud Pro • 3 weeks ago
                </p>
            </div>

        </div>
    </div>
</div>

 <div class="text-center mt-10">
    <button onclick="openReviewModal()"
        class="px-8 py-3 rounded-xl bg-amber-400 text-black font-bold
               hover:bg-amber-300 transition">
        ✍️ Enter Your Review
    </button>
</div>
        <!-- Trust Badges -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-12 border-t border-gray-700 pt-8">
            <div class="text-center">
                <div class="text-3xl md:text-5xl font-bold text-amber-400 mb-1">45K+</div>
                <p class="text-gray-400 text-sm md:text-base font-semibold">Happy Customers</p>
            </div>
            <div class="text-center">
                <div class="text-3xl md:text-5xl font-bold text-amber-400 mb-1">98%</div>
                <p class="text-gray-400 text-sm md:text-base font-semibold">Satisfaction Rate</p>
            </div>
            <div class="text-center">
                <div class="text-3xl md:text-5xl font-bold text-amber-400 mb-1">24/7</div>
                <p class="text-gray-400 text-sm md:text-base font-semibold">Customer Support</p>
            </div>
            <div class="text-center">
                <div class="text-3xl md:text-5xl font-bold text-amber-400 mb-1">100%</div>
                <p class="text-gray-400 text-sm md:text-base font-semibold">Original Products</p>
            </div>
        </div>
    </div>
   
<!-- REVIEW MODAL -->
<div id="reviewModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50 p-4">

    <div class="bg-gray-900 w-full max-w-lg rounded-2xl p-4 sm:p-6 md:p-8 relative border border-gray-700 max-h-[90vh] overflow-y-auto">

        <!-- Close -->
        <button onclick="closeReviewModal()"
            class="absolute top-3 right-3 text-gray-400 hover:text-white text-xl">✕</button>

        <h3 class="text-xl sm:text-2xl font-bold text-white mb-4 text-center">
            📝 Submit Your Review
        </h3>

        <!-- FORM -->
        <form id="reviewForm" class="space-y-3 sm:space-y-4" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <label class="text-gray-300 text-xs sm:text-sm mb-1 block">Your Name</label>
                <input type="text" id="reviewName" placeholder="Enter your name"
                    class="w-full rounded-lg bg-gray-800 border border-gray-700
                           text-white px-3 sm:px-4 py-2 sm:py-3 text-sm focus:outline-none focus:border-amber-400"
                    required>
            </div>

            <!-- Product Name (Optional) -->
            <div>
                <label class="text-gray-300 text-xs sm:text-sm mb-1 block">Product Name (Optional)</label>
                <input type="text" id="productName" placeholder="What product did you buy?"
                    class="w-full rounded-lg bg-gray-800 border border-gray-700
                           text-white px-3 sm:px-4 py-2 sm:py-3 text-sm focus:outline-none focus:border-amber-400">
            </div>

            <!-- Stars -->
            <div>
                <p class="text-gray-300 text-xs sm:text-sm mb-2">Your Rating</p>
                <div class="flex gap-2 text-2xl sm:text-3xl cursor-pointer" id="starRating">
                    <span onclick="setRating(1)" class="hover:scale-110 transition">☆</span>
                    <span onclick="setRating(2)" class="hover:scale-110 transition">☆</span>
                    <span onclick="setRating(3)" class="hover:scale-110 transition">☆</span>
                    <span onclick="setRating(4)" class="hover:scale-110 transition">☆</span>
                    <span onclick="setRating(5)" class="hover:scale-110 transition">☆</span>
                </div>
                <input type="hidden" id="ratingValue" value="0">
            </div>

            <!-- Review -->
            <div>
                <label class="text-gray-300 text-xs sm:text-sm mb-1 block">Your Review</label>
                <textarea rows="4" id="reviewText" placeholder="Write your review..."
                    class="w-full rounded-lg bg-gray-800 border border-gray-700
                           text-white px-3 sm:px-4 py-2 sm:py-3 text-sm focus:outline-none focus:border-amber-400"
                    required></textarea>
            </div>

            <!-- Image Upload (Optional) -->
            <div>
                <label class="text-gray-300 text-xs sm:text-sm mb-1 block">
                    Upload Product Image (Optional)
                </label>
                <input type="file" id="reviewImage" accept="image/*"
                    class="w-full text-xs sm:text-sm text-gray-300
                           file:bg-amber-400 file:text-black
                           file:border-0 file:rounded-lg file:px-3 sm:file:px-4 file:py-1 sm:file:py-2 file:text-xs sm:file:text-sm file:font-semibold file:cursor-pointer">
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-2 sm:py-3 rounded-xl bg-amber-400 text-black
                       font-bold hover:bg-amber-300 transition text-sm sm:text-base mt-4">
                Submit Review
            </button>

            <p id="reviewMsg" class="text-xs sm:text-sm text-amber-300 hidden mt-2 text-center"></p>

        </form>
    </div>
</div>

</section>


<style>
/* Hide default scrollbar */
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>



    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.pagination-dot');
        const totalSlides = slides.length;

        function updateCarousel() {
            // Hide all slides
            slides.forEach((slide, index) => {
                slide.style.opacity = index === currentSlide ? '1' : '0';
            });

            // Update dots
            dots.forEach((dot, index) => {
                dot.style.opacity = index === currentSlide ? '1' : '0.5';
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateCarousel();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateCarousel();
        }

        // Attach click handlers to dots
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => goToSlide(index));
        });

        // Auto-advance slides every 5 seconds
        setInterval(nextSlide, 5000);

        // Initialize
        updateCarousel();

        // ==================== REVIEWS ====================
        // Load reviews from database
        async function loadReviews() {
            try {
                const response = await fetch("{{ route('review.getAll') }}");
                const reviews = await response.json();

                if (reviews.length > 0) {
                    const container = document.getElementById('reviewsContainer');
                    const defaultReviews = document.getElementById('defaultReviews');
                    
                    // Clear default reviews
                    defaultReviews.style.display = 'none';
                    container.innerHTML = '';

                    // Display fetched reviews
                    reviews.forEach(review => {
                        const stars = '★'.repeat(review.rating) + '☆'.repeat(5 - review.rating);
                        const image = review.image ? `{{ asset('storage') }}/${review.image}` : 'https://via.placeholder.com/200x150';
                        const productInfo = review.product_name ? `Purchased: ${review.product_name}` : 'Verified Buyer ✓';

                        const reviewCard = `
                            <div class="min-w-[50%] sm:min-w-[30%] md:min-w-[10%] bg-gray-800/60 border border-gray-700 rounded-xl p-6 hover:border-amber-400/50 hover:scale-105 transition-all duration-300 hover:bg-gray-800/80 flex-shrink-0">
                                <div class="w-full h-[150px] rounded-lg overflow-hidden mb-4">
                                    <img src="${image}" alt="${review.name}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex items-center gap-3 mb-4">
                                    <div>
                                        <h4 class="text-white font-semibold text-sm">${review.name}</h4>
                                        <p class="text-gray-400 text-xs">${productInfo}</p>
                                    </div>
                                </div>
                                <div class="flex text-amber-400 gap-0.5 mb-3 text-sm">
                                    <span>${stars}</span>
                                </div>
                                <p class="text-gray-100 text-sm mb-3 leading-relaxed">"${review.review}"</p>
                                <p class="text-gray-400 text-xs">Submitted: ${new Date(review.created_at).toLocaleDateString()}</p>
                            </div>
                        `;
                        container.innerHTML += reviewCard;
                    });
                }
            } catch (error) {
                console.error('Error loading reviews:', error);
            }
        }

        // Load reviews on page load
        document.addEventListener('DOMContentLoaded', loadReviews);
    </script>

    <script>
        // Client-side validation + AJAX submit for Take Your Order form
        document.addEventListener('DOMContentLoaded', function(){
            const form = document.getElementById('takeOrderForm');
            const email = document.getElementById('contactEmail');
            const phone = document.getElementById('contactPhone');
            const msg = document.getElementById('takeOrderMsg');
            const modal = document.getElementById('orderSuccessModal');

            if (!form) return;

            form.addEventListener('submit', async function(e){
                e.preventDefault();
                msg.classList.add('hidden');

                const emailVal = email.value.trim();
                const phoneVal = phone.value.trim();

                if (!emailVal && !phoneVal) {
                    msg.textContent = 'Please provide an email or phone number.';
                    msg.classList.remove('hidden');
                    return;
                }

                if (emailVal && !/^\S+@\S+\.\S+$/.test(emailVal)) {
                    msg.textContent = 'Please enter a valid email address.';
                    msg.classList.remove('hidden');
                    return;
                }

                if (phoneVal && !/^[0-9+\-() ]{7,20}$/.test(phoneVal)) {
                    msg.textContent = 'Please enter a valid phone number.';
                    msg.classList.remove('hidden');
                    return;
                }

                // Prepare payload for backend (controller accepts email & phone)
                const payload = new URLSearchParams();
                if (emailVal) payload.append('email', emailVal);
                if (phoneVal) payload.append('phone', phoneVal);

                try {
                    const resp = await fetch("{{ route('order.request') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json',
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                        },
                        body: payload.toString()
                    });

                    const data = await resp.json().catch(() => null);

                    if (!resp.ok) {
                        const errMsg = data && data.message ? data.message : 'Failed to send request.';
                        msg.textContent = errMsg;
                        msg.classList.remove('hidden');
                        msg.classList.remove('text-amber-300');
                        msg.classList.add('text-red-400');
                        return;
                    }

                    // Success
                    msg.textContent = (data && data.message) ? data.message : 'Thanks — we will contact you shortly.';
                    msg.classList.remove('hidden');
                    msg.classList.remove('text-amber-300');
                    msg.classList.add('text-green-400');

                    // Show popup modal
                    if (modal) {
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                        const okBtn = modal.querySelector('button');
                        if (okBtn) okBtn.focus();
                        setTimeout(() => { if (modal) { modal.classList.add('hidden'); modal.classList.remove('flex'); } }, 8000);
                    }

                    // Clear inputs after submit
                    email.value = '';
                    phone.value = '';

                } catch (err) {
                    msg.textContent = 'Network error — please try again.';
                    msg.classList.remove('hidden');
                    msg.classList.remove('text-amber-300');
                    msg.classList.add('text-red-400');
                }
            });
        });

        // Modal close function and ESC handler
        function closeOrderModal() {
            const modal = document.getElementById('orderSuccessModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        document.addEventListener('keydown', function(e){
            if (e.key === 'Escape') closeOrderModal();
        });

        // ==================== REVIEW MODAL ====================
        function openReviewModal() {
            document.getElementById('reviewModal').classList.remove('hidden');
            document.getElementById('reviewModal').classList.add('flex');
        }

        function closeReviewModal() {
            document.getElementById('reviewModal').classList.add('hidden');
            document.getElementById('reviewModal').classList.remove('flex');
        }

        // Close on outside click
        document.getElementById('reviewModal').addEventListener('click', function (e) {
            if (e.target === this) closeReviewModal();
        });

        // STAR RATING
        function setRating(rating) {
            const stars = document.querySelectorAll('#starRating span');
            document.getElementById('ratingValue').value = rating;

            stars.forEach((star, index) => {
                star.textContent = index < rating ? '★' : '☆';
                star.style.color = index < rating ? '#fbbf24' : '#9ca3af';
            });
        }

        // REVIEW FORM SUBMISSION
        document.addEventListener('DOMContentLoaded', function() {
            const reviewForm = document.getElementById('reviewForm');
            if (!reviewForm) return;

            reviewForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const name = document.getElementById('reviewName').value.trim();
                const rating = document.getElementById('ratingValue').value;
                const review = document.getElementById('reviewText').value.trim();
                const productName = document.getElementById('productName').value.trim();
                const imageFile = document.getElementById('reviewImage').files[0];
                const msg = document.getElementById('reviewMsg');

                // Validation
                if (!name) {
                    msg.textContent = 'Please enter your name.';
                    msg.classList.remove('hidden');
                    return;
                }

                if (rating === '0') {
                    msg.textContent = 'Please select a rating.';
                    msg.classList.remove('hidden');
                    return;
                }

                if (!review) {
                    msg.textContent = 'Please write a review.';
                    msg.classList.remove('hidden');
                    return;
                }

                // Prepare FormData
                const formData = new FormData();
                formData.append('name', name);
                formData.append('rating', rating);
                formData.append('review', review);
                if (productName) formData.append('product_name', productName);
                if (imageFile) formData.append('image', imageFile);

                try {
                    const response = await fetch("{{ route('review.store') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (response.ok) {
                        msg.textContent = 'Thank you! Your review has been posted.';
                        msg.classList.remove('hidden', 'text-red-400');
                        msg.classList.add('text-green-400');

                        // Reset form
                        reviewForm.reset();
                        document.getElementById('ratingValue').value = '0';
                        const stars = document.querySelectorAll('#starRating span');
                        stars.forEach(star => {
                            star.textContent = '☆';
                            star.style.color = '#9ca3af';
                        });

                        // Reload reviews after 1 second
                        setTimeout(() => {
                            loadReviews();
                            closeReviewModal();
                        }, 1500);
                    } else {
                        msg.textContent = data.message || 'Error submitting review.';
                        msg.classList.remove('hidden', 'text-green-400');
                        msg.classList.add('text-red-400');
                    }
                } catch (error) {
                    msg.textContent = 'Network error. Please try again.';
                    msg.classList.remove('hidden', 'text-green-400');
                    msg.classList.add('text-red-400');
                }
            });
        });
    </script>

@endsection
