@extends('UserView.Home.layout')

@section('title', $product->name . ' - Checkout')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">

    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">Checkout / Place Order</h1>
        <p class="text-gray-500">Review your product, choose payment, and enter shipping details.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- LEFT: Product images + video -->
        <div class="md:col-span-2 space-y-6">

            @php
                // Prefer admin-uploaded buy-only images for the Buy page
                $buyImages = $product->buy_images ?? [];
                $images = $product->images ?? [];
                $imageList = [];
                $mainImage = asset('images/no-image.png');

                if (!empty($buyImages) && is_array($buyImages)) {
                    $imageList = $buyImages;
                    $mainImage = $buyImages[0] ?? $mainImage;
                    $isBuyOnly = true;
                } else {
                    $isBuyOnly = false;
                    if(is_array($images) && count($images)) {
                        if(isset($images[0])) {
                            // flat images
                            $imageList = $images;
                            $mainImage = $images[0];
                        } else {
                            // grouped by color
                            $firstColor = array_key_first($images);
                            $imageList = collect($images)->flatten()->toArray();
                            $mainImage = $images[$firstColor][0] ?? $mainImage;
                        }
                    }
                }
            @endphp

            <!-- Image Slider -->
            <div class="bg-gray-800 rounded-lg p-4">
                <img id="mainProductImage" 
                     src="{{ $mainImage }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-96 object-cover rounded-lg mb-4 transition-all duration-300">

                @if(!empty($imageList))
                    <div class="flex gap-3 overflow-x-auto pb-2">
                        @foreach($imageList as $img)
                            @if(!empty($isBuyOnly))
                                <img class="buy-thumb w-20 h-20 object-cover rounded cursor-pointer border-2" 
                                     src="{{ $img }}" 
                                     data-src="{{ $img }}"
                                     data-type="buy-only"
                                     alt="Buy image"
                                     title="Buy page image"
                                     style="border-color:#ccc;">
                            @else
                                <img class="thumb w-20 h-20 object-cover rounded cursor-pointer border-2 border-transparent hover:border-amber-400 transition" 
                                     src="{{ $img }}" data-src="{{ $img }}">
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product Video -->
            <div class="bg-gray-800 rounded-lg p-6 text-center">
                <h3 class="text-white font-bold mb-2">Product Video</h3>
                @if(!empty($product->video))
                    <video controls class="w-full aspect-video rounded-lg">
                        <source src="{{ $product->video }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @else
                    <div class="aspect-video bg-black/70 rounded flex items-center justify-center text-gray-400">
                        Video not available
                    </div>
                @endif
            </div>

            <!-- Reviews (product-specific) -->
            <div class="bg-gray-800 rounded-lg p-6">
                <h3 class="text-white font-bold mb-4">Customer Reviews</h3>

                <div id="productReviews" class="space-y-4 mb-4">
                    <div class="text-gray-400 text-center">Loading reviews...</div>
                </div>

                <!-- Review form -->
                <form id="productReviewForm" class="space-y-3 bg-gray-900 p-4 rounded">
                    @csrf
                    <input type="hidden" id="pr_product_type" name="product_type" value="{{ $productType }}">
                    <input type="hidden" id="pr_product_id" name="product_id" value="{{ $product->id }}">

                    <div>
                        <label class="block text-sm text-gray-300">Your name</label>
                        <input type="text" id="pr_name" name="name" required class="mt-1 w-full px-3 py-2 rounded bg-white text-black" />
                    </div>

                    <div>
                        <label class="block text-sm text-gray-300">Rating</label>
                        <select id="pr_rating" name="rating" class="mt-1 w-full px-3 py-2 rounded bg-white text-black">
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-300">Message</label>
                        <textarea id="pr_review" name="review" rows="3" required class="mt-1 w-full px-3 py-2 rounded bg-white text-black"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-300">Optional image</label>
                        <input type="file" id="pr_image" name="image" accept="image/*" class="mt-1 text-sm" />
                    </div>

                    <div>
                        <button type="submit" class="px-4 py-2 bg-amber-500 text-white rounded">Submit Review</button>
                    </div>
                </form>
            </div>

        </div>

        <!-- RIGHT: Purchase panel -->
        <div class="md:col-span-1 bg-gradient-to-br from-gray-900 to-gray-800 rounded-lg p-6 space-y-4">

            <div class="relative">
                <h1 class="text-3xl font-extrabold text-white">{{ $product->name }}</h1>
                @if($product->discount)
                    <div class="absolute top-0 right-0 bg-red-500/80 text-white px-3 py-1 rounded text-sm font-semibold">
                        -{{ $product->discount }}%
                    </div>
                @endif
            </div>

            <!-- Pricing Display -->
            <div>
                <div class="text-2xl font-extrabold text-amber-400" id="priceDisplay">Rs {{ number_format($product->sale_price) }}</div>
                <div class="text-xs text-gray-400 mt-1">
                    <span id="pricePerUnit">Rs {{ number_format($product->sale_price) }}</span> × <span id="qtyDisplay">1</span> = <span id="totalPriceDisplay">Rs {{ number_format($product->sale_price) }}</span>
                </div>
                @if($product->orig_price > $product->sale_price)
                    <div class="text-sm text-gray-500 line-through">Rs {{ number_format($product->orig_price) }}</div>
                    <div class="text-green-400 text-sm font-semibold">
                        Save Rs {{ number_format($product->orig_price - $product->sale_price) }} ({{ $product->discount }}%)
                    </div>
                @endif
                <div class="text-xs text-gray-400 mt-1">Incl. taxes</div>
            </div>

            <!-- Description -->
            <p class="text-gray-400 mb-2">{{ $product->description ?: 'Premium quality product' }}</p>
            <div class="mb-4">
    <label class="text-white font-semibold mb-1 block">Quantity</label>
    <input type="number" 
           id="quantity_{{ $product->id }}"
           name="quantity"
           value="1"
           min="1"
           class="w-24 px-2 py-1 rounded text-black">
                <div id="colorSelectedInfo" class="text-sm text-gray-300 mt-2">Selected: <span id="selectedCount">0</span> / <span id="selectedMax">1</span></div>
                <div id="selectedWarning" class="text-sm text-red-400 mt-1 hidden">Selected total exceeds quantity. Reduce color quantities.</div>
</div>


            <!-- Color selection flow (COD only) -->
            @if(!empty($product->colors))
            <div id="colorSection" class="mb-4 hidden">
                <div id="colorSummary" class="text-gray-300 mb-2"></div>
                <button type="button" id="addMoreColorBtn" class="px-3 py-1 bg-amber-500 text-white rounded hidden">Add / Edit Colors</button>

                <div id="colorPicker" class="mt-2 hidden bg-gray-800 p-3 rounded">
                    <div class="flex flex-wrap gap-2">
                        @foreach($product->colors as $colorName => $colorCode)
                            @php
                                $colorImage = $mainImage;
                                if(isset($product->images[$colorName])) {
                                    $colorImage = $product->images[$colorName][0] ?? $mainImage;
                                }
                            @endphp

                            <label class="cursor-pointer flex items-center gap-2 p-1 rounded border border-transparent hover:border-amber-400 transition">
                                <input type="checkbox" name="colors[]" value="{{ $colorName }}" class="color-checkbox" data-color="{{ $colorName }}" data-img="{{ $colorImage }}">
                                <span class="w-6 h-6 rounded-full inline-block" style="background-color: {{ $colorCode }}"></span>
                                <span class="text-white ml-1">{{ ucfirst($colorName) }}</span>
                                <input type="number" min="1" value="1" class="color-qty ml-2 w-20 px-2 py-1 rounded text-black hidden" placeholder="Pieces">
                            </label>
                        @endforeach
                    </div>
                    <div class="text-sm text-gray-400 mt-2">Select up to <span id="maxColorCount">1</span> color(s) matching quantity.</div>
                    <div class="mt-2">
                        <button type="button" id="doneColorsBtn" class="px-3 py-1 bg-amber-500 rounded">Done</button>
                    </div>
                </div>
            </div>
            @endif

            <!-- Payment Methods -->
            <div class="mb-4">
                <h4 class="text-white font-semibold mb-2">Payment Method</h4>
                <div class="space-y-2 text-gray-200">
                    <!-- Cash on Delivery (main option) -->
                    <label class="flex items-center gap-3">
                        <input type="radio" name="payment" value="cod" id="payment_cod" class="form-radio" />
                        <span>Cash on Delivery (Delivery Charges Advanced only 250)</span>
                    </label>

                    <!-- Nested payment methods (shown when COD selected) -->
                    <div id="codPaymentMethods" class="hidden ml-6 space-y-2 bg-gray-900 p-3 rounded">
                        <label class="flex items-center gap-3">
                            <input type="radio" name="payment_sub" value="bank" class="form-radio" />
                            <span>Bank Transfer</span>
                        </label>

                        <label class="flex items-center gap-3">
                            <input type="radio" name="payment_sub" value="easypaisa" class="form-radio" />
                            <span>Easypaisa</span>
                        </label>

                        <label class="flex items-center gap-3">
                            <input type="radio" name="payment_sub" value="jazzcash" class="form-radio" />
                            <span>JazzCash</span>
                        </label>

                        <!-- Payment details (shown when sub-method selected) -->
                        <div id="paymentDetailsSection" class="hidden mt-2 bg-gray-800 p-3 rounded">
                            <div class="text-sm text-gray-300 mb-2">Send payment to the account below and upload a screenshot proof.</div>
                            
                            <!-- Account Info Display (Bank) -->
                            <div id="bankAccountInfo" class="hidden bg-gray-700 p-2 rounded mb-2">
                                <div class="text-sm text-gray-300"><span class="text-amber-400 font-semibold">Account Name:</span> sphaib</div>
                                <div class="text-sm text-gray-300"><span class="text-amber-400 font-semibold">Account Number:</span> 03245032005</div>
                            </div>

                            <!-- Account Info Display (Easypaisa) -->
                            <div id="easypaisaAccountInfo" class="hidden bg-gray-700 p-2 rounded mb-2">
                                <div class="text-sm text-gray-300"><span class="text-amber-400 font-semibold">Account Name:</span> ssohaib</div>
                                <div class="text-sm text-gray-300"><span class="text-amber-400 font-semibold">Account Number:</span> 03275032005</div>
                            </div>

                            <!-- Account Info Display (JazzCash) -->
                            <div id="jazzcashAccountInfo" class="hidden bg-gray-700 p-2 rounded mb-2">
                                <div class="text-sm text-gray-300"><span class="text-amber-400 font-semibold">Account Name:</span> sphaib</div>
                                <div class="text-sm text-gray-300"><span class="text-amber-400 font-semibold">Account Number:</span> 03245032005</div>
                            </div>
                            
                            <!-- Transaction ID (optional) -->
                            <input type="text" name="payment_transaction_id" id="payment_transaction_id" placeholder="Transaction ID (optional)" class="w-full px-3 py-2 rounded bg-white text-black mb-2" />
                            
                            <!-- Screenshot upload -->
                            <label class="text-sm text-gray-400">Upload payment screenshot</label>
                            <input type="file" name="payment_proof" id="payment_proof" accept="image/*" class="mt-1 w-full text-sm" />
                            <div id="paymentProofMsg" class="text-red-400 text-sm mt-2 hidden">First upload a screenshot proof of the payment</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Form -->
            <form id="checkoutForm" class="space-y-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="product_name" value="{{ $product->name }}">
                <input type="hidden" name="price" value="{{ $product->sale_price }}">

                <h4 class="text-white font-semibold mb-2">Shipping Information</h4>
                
                <input type="text" id="shipName" name="shipName" placeholder="Full name" class="w-full px-3 py-2 rounded bg-white text-black" />
                <input type="text" id="shipPhone" name="buyer_phone" placeholder="Phone number" class="w-full px-3 py-2 rounded bg-white text-black" />
                <input type="text" id="shipAddress" name="shipAddress" placeholder="Address" class="w-full px-3 py-2 rounded bg-white text-black" />
                <input type="text" id="shipCity" name="shipCity" placeholder="City" class="w-full px-3 py-2 rounded bg-white text-black" />
                <input type="text" id="shipNearby" name="shipNearby" placeholder="Nearby / Landmark" class="w-full px-3 py-2 rounded bg-white text-black" />

                <select id="shipCountry" name="shipCountry" class="w-full px-3 py-2 rounded bg-white text-black">
                    <option value="Pakistan" selected>Pakistan</option>
                </select>

                <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white py-3 rounded-full font-semibold mt-3">Place Order</button>
            </form>

            <p id="checkoutMsg" class="text-sm text-amber-300 hidden"></p>
        </div>

    </div>
</div>

<!-- Success modal -->
<div id="checkoutSuccessModal" class="hidden fixed inset-0 bg-black/60 items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-900 rounded-xl max-w-md w-full mx-4 p-6 text-center shadow-2xl">
        <button class="absolute top-4 right-4 text-gray-700 hover:text-gray-900" aria-label="Close" onclick="closeCheckoutModal()">✕</button>
        <div class="py-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Thank you!</h3>
            <p class="text-gray-700 dark:text-gray-300">Your order is received. Company will contact you within 24 hours.</p>
        </div>
        <div class="mt-4">
            <button onclick="closeCheckoutModal()" class="bg-amber-500 hover:bg-amber-600 text-white px-5 py-2 rounded-full font-semibold">OK</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){

    // Thumbnails (include buy-only thumbnails)
    document.querySelectorAll('.thumb, .buy-thumb').forEach(t=>{
        t.addEventListener('click', function(){
            document.querySelectorAll('.thumb, .buy-thumb').forEach(x=> x.classList.remove('border-amber-400'));
            this.classList.add('border-amber-400');
            const main = document.getElementById('mainProductImage');
            if(main) main.src = this.getAttribute('data-src');
        });
    });

    // Elements
    const qtyInput = document.getElementById('quantity_{{ $product->id }}');
    const colorSection = document.getElementById('colorSection');
    const addMoreColorBtn = document.getElementById('addMoreColorBtn');
    const colorPicker = document.getElementById('colorPicker');
    const colorSummary = document.getElementById('colorSummary');
    const doneColorsBtn = document.getElementById('doneColorsBtn');
    const checkoutForm = document.getElementById('checkoutForm');
    const checkoutMsg = document.getElementById('checkoutMsg');
    const paymentProofInput = document.getElementById('payment_proof');
    const paymentRadios = document.querySelectorAll('input[name="payment"]');
    const paymentSubRadios = document.querySelectorAll('input[name="payment_sub"]');
    const maxColorCountSpan = document.getElementById('maxColorCount');
    const mainImageEl = document.getElementById('mainProductImage');
    const codPaymentMethods = document.getElementById('codPaymentMethods');
    const paymentDetailsSection = document.getElementById('paymentDetailsSection');

    // Selected colors total UI elements
    const selectedCountEl = document.getElementById('selectedCount');
    const selectedMaxEl = document.getElementById('selectedMax');
    const selectedWarningEl = document.getElementById('selectedWarning');

    function getQty(){ return Math.max(1, parseInt(qtyInput.value) || 1); }

    function updateMaxCount(){ if(maxColorCountSpan) maxColorCountSpan.textContent = getQty(); }

    function computeSelectedColorQty(){
        let sum = 0;
        document.querySelectorAll('.color-checkbox:checked').forEach(cb=>{
            const qInput = cb.parentElement.querySelector('.color-qty');
            const val = Math.max(1, parseInt(qInput?.value || '1'));
            sum += val;
        });
        return sum;
    }

    function updateSelectedCountDisplay(){
        const qty = getQty();
        const sum = computeSelectedColorQty();
        if(selectedCountEl) selectedCountEl.textContent = sum;
        if(selectedMaxEl) selectedMaxEl.textContent = qty;
        if(selectedWarningEl){
            if(sum > qty) selectedWarningEl.classList.remove('hidden'); else selectedWarningEl.classList.add('hidden');
        }
    }

    function attachColorHandlers(){
        document.querySelectorAll('.color-checkbox').forEach(cb=>{
            cb.addEventListener('change', function(e){
                const qty = getQty();
                const qInput = this.parentElement.querySelector('.color-qty');
                const qVal = Math.max(1, parseInt(qInput?.value || '1'));
                if(this.checked){
                    // compute sum without this box
                    let otherSum = 0;
                    document.querySelectorAll('.color-checkbox:checked').forEach(other=>{ if(other !== this){ const v = Math.max(1, parseInt(other.parentElement.querySelector('.color-qty')?.value || '1')); otherSum += v; }});
                    if(otherSum + qVal > qty){
                        this.checked = false;
                        if(qInput) qInput.classList.add('hidden');
                        alert('Selecting this color would exceed the total quantity.');
                    } else {
                        if(qInput) qInput.classList.remove('hidden');
                    }
                } else {
                    if(qInput) qInput.classList.add('hidden');
                }
                // initialize data-prev for qty inputs
                if(qInput && !qInput.getAttribute('data-prev')) qInput.setAttribute('data-prev', qInput.value || '1');
                updateSelectedCountDisplay();
            });
        });

        document.querySelectorAll('.color-qty').forEach(qi=>{
            // initialize prev
            if(!qi.getAttribute('data-prev')) qi.setAttribute('data-prev', qi.value || '1');
            qi.addEventListener('input', function(){
                const prev = parseInt(this.getAttribute('data-prev') || '1');
                const newVal = Math.max(1, parseInt(this.value || '1'));
                const qty = getQty();
                // compute sum of others
                let others = 0;
                document.querySelectorAll('.color-checkbox:checked').forEach(cb=>{
                    const q = cb.parentElement.querySelector('.color-qty');
                    if(q && q !== this) others += Math.max(1, parseInt(q.value || '1'));
                });
                if(others + newVal > qty){
                    alert('Total selected quantity exceeds overall quantity.');
                    this.value = prev;
                } else {
                    this.setAttribute('data-prev', String(newVal));
                }
                updateSelectedCountDisplay();
            });
        });
    }

    function updateDynamicPrice(){
        const basePrice = {{ $product->sale_price }};
        const qty = getQty();
        const totalPrice = basePrice * qty;
        document.getElementById('qtyDisplay').textContent = qty;
        document.getElementById('totalPriceDisplay').textContent = 'Rs ' + totalPrice.toLocaleString();
        document.getElementById('priceDisplay').textContent = 'Rs ' + totalPrice.toLocaleString();
    }

    function clearColorSelections(){
        document.querySelectorAll('.color-checkbox').forEach(cb=>{ cb.checked = false; const q = cb.parentElement.querySelector('.color-qty'); if(q) q.classList.add('hidden'); });
        colorSummary.textContent = '';
        // remove any previous hidden inputs
        checkoutForm.querySelectorAll('input[data-selected-color]').forEach(i=>i.remove());
    }

    function showAddMoreIfApplicable(){
        const codSelected = document.getElementById('payment_cod')?.checked;
        if(!colorSection) return;
        if(codSelected){
            colorSection.classList.remove('hidden');
            if(getQty() > 0) addMoreColorBtn.classList.remove('hidden');
        } else {
            colorSection.classList.add('hidden');
            addMoreColorBtn.classList.add('hidden');
            colorPicker.classList.add('hidden');
            clearColorSelections();
        }
    }

    // Wire payment radios
    paymentRadios.forEach(r=> r.addEventListener('change', function(){
        if(this.value === 'cod'){
            if(codPaymentMethods) codPaymentMethods.classList.remove('hidden');
        } else {
            if(codPaymentMethods) codPaymentMethods.classList.add('hidden');
            if(paymentDetailsSection) paymentDetailsSection.classList.add('hidden');
        }
        showAddMoreIfApplicable();
    }));

    // Wire payment sub-radios (Bank/Easypaisa/JazzCash under COD)
    paymentSubRadios.forEach(r=> r.addEventListener('change', function(){
        if(paymentDetailsSection){
            if(this.checked){
                paymentDetailsSection.classList.remove('hidden');
                // Show appropriate account info
                document.getElementById('bankAccountInfo')?.classList.add('hidden');
                document.getElementById('easypaisaAccountInfo')?.classList.add('hidden');
                document.getElementById('jazzcashAccountInfo')?.classList.add('hidden');
                
                if(this.value === 'bank'){
                    document.getElementById('bankAccountInfo')?.classList.remove('hidden');
                } else if(this.value === 'easypaisa'){
                    document.getElementById('easypaisaAccountInfo')?.classList.remove('hidden');
                } else if(this.value === 'jazzcash'){
                    document.getElementById('jazzcashAccountInfo')?.classList.remove('hidden');
                }
            }
        }
    }));

    // Quantity change
    qtyInput.addEventListener('change', function(){ updateMaxCount(); updateDynamicPrice(); showAddMoreIfApplicable(); });
    qtyInput.addEventListener('input', function(){ updateMaxCount(); updateDynamicPrice(); showAddMoreIfApplicable(); });
    updateMaxCount();
    updateDynamicPrice();
    showAddMoreIfApplicable();

    // Add/Edit Colors button
    addMoreColorBtn?.addEventListener('click', function(){
        if(!colorPicker) return;
        colorPicker.classList.toggle('hidden');
        // ensure handlers
        attachColorHandlers();
        // when clicking on a color label, if it has data-img, update main image
        document.querySelectorAll('.color-checkbox').forEach(cb=>{
            cb.addEventListener('click', function(){
                const img = this.getAttribute('data-img');
                if(img && mainImageEl) mainImageEl.src = img;
            });
        });
        // update display initially
        updateSelectedCountDisplay();
    });

    // Done selecting colors
    doneColorsBtn?.addEventListener('click', function(){
        const selected = Array.from(document.querySelectorAll('.color-checkbox:checked'));
        if(selected.length === 0){
            colorSummary.textContent = 'No colors selected.';
            colorPicker.classList.add('hidden');
            checkoutForm.querySelectorAll('input[data-selected-color]').forEach(i=>i.remove());
            return;
        }

        // Collect quantities - simple, no validation
        const pairs = [];
        for(const cb of selected){
            const name = cb.getAttribute('data-color') || cb.value;
            const qInput = cb.parentElement.querySelector('.color-qty');
            const q = Math.max(1, parseInt(qInput?.value || '1'));
            pairs.push({name, qty: q});
        }

        // Validate total selected equals requested quantity
        const totalSelected = pairs.reduce((s,p)=>s+p.qty,0);
        const expected = getQty();
        if(totalSelected !== expected){
            alert('Selected total ('+totalSelected+') does not match quantity ('+expected+'). Please adjust.');
            return;
        }

        // Add hidden inputs to form
        checkoutForm.querySelectorAll('input[data-selected-color]').forEach(i=>i.remove());
        pairs.forEach(p=>{
            const inp = document.createElement('input'); inp.type='hidden'; inp.name='selected_colors[]'; inp.value = p.name; inp.setAttribute('data-selected-color','1');
            checkoutForm.appendChild(inp);
            const inp2 = document.createElement('input'); inp2.type='hidden'; inp2.name = 'selected_color_qtys['+p.name+']'; inp2.value = p.qty; inp2.setAttribute('data-selected-color','1');
            checkoutForm.appendChild(inp2);
        });

        // Show summary
        colorSummary.innerHTML = pairs.map(p=>`<span class="inline-block mr-2">${p.name} × ${p.qty}</span>`).join('');
        colorPicker.classList.add('hidden');
    });

    // Checkout submit — validate and POST to backend
    checkoutForm?.addEventListener('submit', async function(e){
        e.preventDefault();
        checkoutMsg.classList.add('hidden');
        const name = document.getElementById('shipName').value.trim();
        const address = document.getElementById('shipAddress').value.trim();
        const city = document.getElementById('shipCity').value.trim();
        const phone = document.getElementById('shipPhone')?.value.trim() || '';
        if(!name || !address || !city){ alert('Please fill name, address, and city.'); return; }

        const payment = document.querySelector('input[name="payment"]:checked')?.value || '';
        if(payment === ''){ alert('Please select a payment method.'); return; }

        let paymentSub = '';
        if(payment === 'cod'){
            paymentSub = document.querySelector('input[name="payment_sub"]:checked')?.value || '';
            if(paymentSub === ''){ alert('Please select a payment sub-method (Bank/Easypaisa/JazzCash).'); return; }
            if(!paymentProofInput || !paymentProofInput.files || paymentProofInput.files.length === 0){ alert('Please upload payment screenshot.'); return; }
        }

        // Build FormData from form and include fields that are outside the form
        const fd = new FormData(this);
        fd.append('payment', payment);
        fd.append('payment_sub', paymentSub);
        fd.append('buyer_phone', phone);
        // quantity input is outside the form; include it explicitly
        fd.append('quantity', String(getQty()));
        // payment transaction id (may be outside form)
        const payTxn = document.getElementById('payment_transaction_id')?.value || '';
        if(payTxn) fd.append('payment_transaction_id', payTxn);
        // append product_type if available
        const prType = document.getElementById('pr_product_type')?.value;
        if(prType) fd.append('product_type', prType);

        // collect selected colors and their qtys (in case Done wasn't pressed)
        document.querySelectorAll('.color-checkbox').forEach(cb=>{
            if(cb.checked){
                const name = cb.getAttribute('data-color') || cb.value;
                const qInput = cb.parentElement.querySelector('.color-qty');
                const q = Math.max(1, parseInt(qInput?.value || '1'));
                fd.append('selected_colors[]', name);
                fd.append('selected_color_qtys['+name+']', String(q));
            }
        });

        // if file present, append
        if(paymentProofInput && paymentProofInput.files && paymentProofInput.files[0]){
            fd.append('payment_proof', paymentProofInput.files[0]);
        }

        // send to backend
        // Optimistic UI: show confirmation immediately, send request in background
        document.getElementById('checkoutSuccessModal').classList.remove('hidden');
        document.getElementById('checkoutSuccessModal').classList.add('flex');
        this.querySelector('button[type="submit"]')?.setAttribute('disabled','disabled');
        // send request but don't block UI — handle errors when response arrives
        fetch('{{ route('order.place') }}', {
            method: 'POST',
            body: fd,
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(async function(res){
            const json = await res.json().catch(()=>null);
            if(!res.ok || !(json && json.status)){
                // Show error to user (could be validation or server failure)
                let msg = 'Failed to place order.';
                if(json && json.errors){ const errs = []; Object.values(json.errors).forEach(arr=>{ if(Array.isArray(arr)) errs.push(...arr); }); msg = errs.join('\n'); }
                else if(json && json.message) msg = json.message;
                alert(msg);
                // hide success modal so user can retry
                document.getElementById('checkoutSuccessModal').classList.add('hidden');
                document.getElementById('checkoutSuccessModal').classList.remove('flex');
            } else {
                // success confirmed by server — clear form server-side already handled
            }
        }).catch(function(err){
            console.error('Order submit error', err);
            alert('Failed to place order (network error)');
            document.getElementById('checkoutSuccessModal').classList.add('hidden');
            document.getElementById('checkoutSuccessModal').classList.remove('flex');
        });
    });

    // --- Reviews: keep existing behaviour ---
    async function loadProductReviews(){
        const productType = document.getElementById('pr_product_type')?.value || '';
        const productId = document.getElementById('pr_product_id')?.value || '';
        const area = document.getElementById('productReviews');
        if(!productType || !productId){ area.innerHTML = '<div class="text-gray-400 text-center">No reviews available</div>'; console.error('Missing product_type or product_id:', {productType, productId}); return; }
        area.innerHTML = '<div class="text-gray-400 text-center">Loading reviews...</div>';
        try{
            const url = `{{ route('product.review.list') }}?product_type=${encodeURIComponent(productType)}&product_id=${encodeURIComponent(productId)}`;
            const res = await fetch(url, { headers: { 'Accept':'application/json','X-CSRF-TOKEN': '{{ csrf_token() }}' }, credentials: 'same-origin' });
            const data = await res.json();
            if(!data || data.length===0){ area.innerHTML = '<div class="text-gray-400 text-center">No reviews yet.</div>'; return; }
            area.innerHTML = '';
            data.forEach(function(r){
                const card = document.createElement('div'); card.className = 'bg-gray-900 rounded p-4';
                const initials = (r.name||'U').substring(0,2).toUpperCase();
                const avatarHtml = r.image_url ? `<img src="${r.image_url}" class="w-14 h-14 rounded-full object-cover" alt="${r.name}">` : `<div class="w-14 h-14 rounded-full bg-amber-500 flex items-center justify-center text-white font-bold">${initials}</div>`;
                card.innerHTML = `
                    <div class="flex items-center gap-3 mb-2">
                        ${avatarHtml}
                        <div>
                            <div class="text-white font-semibold">${r.name || 'Anonymous'}</div>
                            <div class="text-xs text-gray-400">${r.rating || ''} ★</div>
                        </div>
                    </div>
                    <p class="text-gray-300 text-sm">${r.review || ''}</p>
                `;
                area.appendChild(card);
            });
        }catch(e){ console.error('Error loading reviews', e); area.innerHTML = '<div class="text-gray-400 text-center">Failed to load reviews</div>'; }
    }
    loadProductReviews();

    document.getElementById('productReviewForm')?.addEventListener('submit', async function(e){
        e.preventDefault();
        const btn = this.querySelector('button[type="submit"]'); btn.disabled = true; const formData = new FormData(this);
        const productType = document.getElementById('pr_product_type')?.value; const productId = document.getElementById('pr_product_id')?.value;
        if(!productType || !productId){ alert('Product info missing'); btn.disabled = false; return; }
        try{ const res = await fetch('{{ route('product.review.store') }}', { method: 'POST', body: formData, credentials: 'same-origin', headers: { 'Accept':'application/json','X-CSRF-TOKEN': '{{ csrf_token() }}' } }); const json = await res.json(); if(json.success){ this.reset(); loadProductReviews(); } else { alert('Failed to submit review'); } }catch(err){ console.error('Review submit error:', err); alert('Failed to submit review'); }
        btn.disabled = false;
    });

});

function closeCheckoutModal(){ const modal = document.getElementById('checkoutSuccessModal'); modal.classList.add('hidden'); modal.classList.remove('flex'); }
document.addEventListener('keydown', function(e){ if(e.key==='Escape') closeCheckoutModal(); });
</script>
@endpush

@endsection
