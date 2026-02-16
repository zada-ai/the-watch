<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderRequestController as AdminOrderRequestController;
use App\Http\Controllers\Admin\BestSellerController as AdminBestSellerController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\OrderRequestController;
use App\Http\Controllers\OrderController;
use App\Models\BestSeller;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\BestSellerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\WatchesPageController as AdminWatchesPageController;
use App\Http\Controllers\Admin\HeadphonesController as AdminHeadphonesController;

Route::get('/', [BestSellerController::class, 'index'])->name('user.home');


Route::get('/test', function () {
    return response()->json([
        "status" => true,
        "message" => "API working"
    ]);
});

// Review Routes
Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
Route::get('/reviews/get-all', [ReviewController::class, 'getAll'])->name('review.getAll');
// Product specific reviews
use App\Http\Controllers\ProductReviewController;
Route::post('/product-review', [ProductReviewController::class, 'store'])
    ->name('product.review.store');

Route::get('/product-review/list', [ProductReviewController::class, 'listByProduct'])
    ->name('product.review.list');

Route::get('/best-seller-test', function () {
    return "BEST SELLER WORKS!";
});

// Debug route: send a quick test mail and return any exception (local only)
Route::get('/debug-send-mail', function () {
    if (!app()->environment('local')) {
        abort(403);
    }
    try {
        $recipient = config('mail.from.address') ?: env('MAIL_USERNAME');
        Mail::raw('Debug test mail', function ($m) use ($recipient) {
            $m->to($recipient)->subject('Debug Test Mail');
        });
        return response()->json(['status' => true, 'message' => 'Mail sent to '.$recipient]);
    } catch (\Exception $e) {
        return response()->json(['status' => false, 'message' => $e->getMessage(), 'trace' => substr($e->getTraceAsString(),0,2000)], 500);
    }
})->name('debug.send');

Route::view('/login', 'UserView.auth.login')->name('login');
Route::view('/register', 'UserView.auth.register')->name('register.view');
Route::get('/', [HomeController::class, 'index'])->name('user.home');


// Best Seller Page
use App\Http\Controllers\BestSellerViewController;

Route::get('/best-seller', [BestSellerViewController::class, 'index'])->name('best-seller');
// Exclusive Collections


// Buy / Checkout page — handled by controller (supports BestSeller + Product)
use App\Http\Controllers\BuyController;
Route::get('/buy', [BuyController::class, 'buy'])->name('buy');
Route::get('/New-Launched', function () {
    $cards = [];
    $discounts = [45, 35, 55, 25, 40, 30, 50, 20, 60, 15, 38, 42];
    for ($i = 1; $i <= 12; $i++) {
        $cards[] = [
            'id' => 'new_launched_'.$i,
            'name' => 'New Launched Watch '.chr(64 + $i),
            'discount' => $discounts[$i-1],
            'rating' => number_format(rand(42, 50) / 10, 1),
            'reviews' => rand(200, 6000),
            'images' => [
                asset('LOGO/The-watch-logo.svg'),
                'https://via.placeholder.com/420x320/1f3a5f/ffffff?text=Variant+'.($i),
                'https://via.placeholder.com/420x320/8b4513/ffffff?text=Brown+'.($i),
            ],
            'orig_price' => rand(10000,18000),
            'sale_price' => rand(2000,8000)
        ];
    }

    return view('UserView.Home.New-launch', compact('cards'));
})->name('new-launched');

// Watches Page
use App\Http\Controllers\WatchesController;
Route::get('/watches', [WatchesController::class, 'index'])->name('watches');
Route::get('/watches/men', [WatchesController::class, 'index'])->name('watches.men');
Route::get('/watches/women', [WatchesController::class, 'index'])->name('watches.women');

// Headphones Page
use App\Http\Controllers\HeadphonesController;
Route::get('/headphones', [HeadphonesController::class, 'index'])->name('headphones');
Route::get('/headphones/men', [HeadphonesController::class, 'index'])->name('headphones.men');
Route::get('/headphones/women', [HeadphonesController::class, 'index'])->name('headphones.women');

// Airbuds Page
use App\Http\Controllers\AirbudsController;
Route::get('/airbuds', [AirbudsController::class, 'index'])->name('airbuds');
Route::get('/airbuds/men', [AirbudsController::class, 'index'])->name('airbuds.men');
Route::get('/airbuds/women', [AirbudsController::class, 'index'])->name('airbuds.women');

// Perfume Page
use App\Http\Controllers\PerfumeController;
Route::get('/perfume', [PerfumeController::class, 'index'])->name('perfume');
Route::get('/perfume/men', [PerfumeController::class, 'index'])->name('perfume.men');
Route::get('/perfume/women', [PerfumeController::class, 'index'])->name('perfume.women');

// Wallets Page
use App\Http\Controllers\WalletsController;
Route::get('/wallets', [WalletsController::class, 'index'])->name('wallets');
Route::get('/wallets/men', [WalletsController::class, 'index'])->name('wallets.men');
Route::get('/wallets/women', [WalletsController::class, 'index'])->name('wallets.women');

// Toys Page
use App\Http\Controllers\ToysController;
Route::get('/toys', [ToysController::class, 'index'])->name('toys');
Route::get('/toys/kids', [ToysController::class, 'index'])->name('toys.kids');
Route::get('/toys/smart', [ToysController::class, 'index'])->name('toys.smart');

// Search
Route::get('/search', function () {
    return 'Search Working';
})->name('search');

// Cart
Route::get('/cart', function () {
    return 'Cart Page';
})->name('cart');
Route::get('/Support', function () {
    return view('UserView.Home.Support');
})->name('Support');

Route::get('/Home', function () {
    return view('UserView.Home.homepage');
})->name('Home');

use App\Http\Controllers\WatchesPageController;

Route::get('/watches', [WatchesPageController::class, 'index'])
    ->name('watches');


Route::post('/order-request', [OrderRequestController::class, 'store'])->name('order.request');
Route::post('/place-order', [OrderController::class, 'store'])->name('order.place');

Route::prefix('admin')->group(function () {
    Route::get('/login', fn() => view('Admin.Loginpage.index'))->name('admin.login.form');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', fn() => view('Admin.dashboard'))->name('admin.dashboard');
        
        // Product CRUD Routes
        Route::resource('products', AdminProductController::class, ['names' => [
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'store' => 'admin.products.store',
            'edit' => 'admin.products.edit',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy',
        ]]);

        // Order Requests Routes
        Route::get('/orders', [AdminOrderRequestController::class, 'index'])->name('admin.orders.index');
        Route::delete('/orders/{order}', [AdminOrderRequestController::class, 'destroy'])->name('admin.orders.destroy');

        // Best Seller CRUD Routes
        Route::resource('bestseller', AdminBestSellerController::class, ['names' => [
            'index' => 'admin.bestseller.index',
            'create' => 'admin.bestseller.create',
            'store' => 'admin.bestseller.store',
            'edit' => 'admin.bestseller.edit',
            'update' => 'admin.bestseller.update',
            'destroy' => 'admin.bestseller.destroy',
        ]]);
        Route::post('/bestseller/{bestseller}/toggle', [AdminBestSellerController::class, 'toggleActive'])->name('admin.bestseller.toggle');

        // WatchesPage CRUD Routes (admin)
        Route::resource('watchespage', AdminWatchesPageController::class, ['names' => [
            'index' => 'admin.watchespage.index',
            'create' => 'admin.watchespage.create',
            'store' => 'admin.watchespage.store',
            'edit' => 'admin.watchespage.edit',
            'update' => 'admin.watchespage.update',
            'destroy' => 'admin.watchespage.destroy',
        ]]);

        // Review CRUD Routes
        Route::resource('reviews', AdminReviewController::class, ['names' => [
            'index' => 'admin.reviews.index',
            'create' => 'admin.reviews.create',
            'store' => 'admin.reviews.store',
            'edit' => 'admin.reviews.edit',
            'update' => 'admin.reviews.update',
            'destroy' => 'admin.reviews.destroy',
        ]]);
        
        // Headphones CRUD Routes (admin)
        Route::resource('headphones', AdminHeadphonesController::class, ['names' => [
            'index' => 'admin.headphones.index',
            'create' => 'admin.headphones.create',
            'store' => 'admin.headphones.store',
            'edit' => 'admin.headphones.edit',
            'update' => 'admin.headphones.update',
            'destroy' => 'admin.headphones.destroy',
        ]]);

        // Airbuds CRUD Routes (admin)
        Route::resource('airbuds', App\Http\Controllers\Admin\AirbudsController::class, ['names' => [
            'index' => 'admin.airbuds.index',
            'create' => 'admin.airbuds.create',
            'store' => 'admin.airbuds.store',
            'edit' => 'admin.airbuds.edit',
            'update' => 'admin.airbuds.update',
            'destroy' => 'admin.airbuds.destroy',
        ]]);

        // Perfume CRUD Routes (admin)
        Route::resource('perfume', App\Http\Controllers\Admin\PerfumeController::class, ['names' => [
            'index' => 'admin.perfume.index',
            'create' => 'admin.perfume.create',
            'store' => 'admin.perfume.store',
            'edit' => 'admin.perfume.edit',
            'update' => 'admin.perfume.update',
            'destroy' => 'admin.perfume.destroy',
        ]]);

        // Toys CRUD Routes (admin)
        Route::resource('toys', App\Http\Controllers\Admin\ToysController::class, ['names' => [
            'index' => 'admin.toys.index',
            'create' => 'admin.toys.create',
            'store' => 'admin.toys.store',
            'edit' => 'admin.toys.edit',
            'update' => 'admin.toys.update',
            'destroy' => 'admin.toys.destroy',
        ]]);

        // Wallets CRUD Routes (admin)
        Route::resource('wallets', App\Http\Controllers\Admin\WalletsController::class, ['names' => [
            'index' => 'admin.wallets.index',
            'create' => 'admin.wallets.create',
            'store' => 'admin.wallets.store',
            'edit' => 'admin.wallets.edit',
            'update' => 'admin.wallets.update',
            'destroy' => 'admin.wallets.destroy',
        ]]);

        // Buy-only images for Buy Now page (admin)
        Route::get('/buy-images', [App\Http\Controllers\BuyImage::class, 'adminForm'])->name('admin.buy-images.index');
        Route::post('/buy-images', [App\Http\Controllers\BuyImage::class, 'store'])->name('admin.buy-images.store');
        Route::delete('/buy-images/{id}', [App\Http\Controllers\BuyImage::class, 'destroy'])->name('admin.buy-images.destroy');
        Route::get('/buy-images/list', [App\Http\Controllers\BuyImage::class, 'index'])->name('admin.buy-images.list');

        // Buy-only videos for Buy Now page (admin)
        Route::get('/buy-videos', [App\Http\Controllers\BuyVideo::class, 'adminForm'])->name('admin.buy-videos.index');
        Route::post('/buy-videos', [App\Http\Controllers\BuyVideo::class, 'store'])->name('admin.buy-videos.store');
        Route::delete('/buy-videos/{id}', [App\Http\Controllers\BuyVideo::class, 'destroy'])->name('admin.buy-videos.destroy');
        Route::get('/buy-videos/list', [App\Http\Controllers\BuyVideo::class, 'index'])->name('admin.buy-videos.list');
        
        // Placed Orders (created by frontend checkout)
        Route::get('/placed-orders', [App\Http\Controllers\Admin\PlacedOrderController::class, 'index'])->name('admin.placed-orders.index');
        Route::get('/placed-orders/{order}', [App\Http\Controllers\Admin\PlacedOrderController::class, 'show'])->name('admin.placed-orders.show');
    });
});

