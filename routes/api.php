<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BestController;

// -------- Product API Routes --------
Route::prefix('products')->group(function () {
    // Get all products
    Route::get('/', [ProductController::class, 'index']);
    
    // Get products by category (watches, headphones, airbuds)
    Route::get('/category/{category}', [ProductController::class, 'getByCategory']);
    
    // Get featured products
    Route::get('/featured/{category?}', [ProductController::class, 'featured']);
    
    // Get single product
    Route::get('/{id}', [ProductController::class, 'show']);
    
    // Create product (requires authentication)
    Route::post('/', [ProductController::class, 'store'])->middleware('auth:sanctum');
    
    // Update product (requires authentication)
    Route::put('/{id}', [ProductController::class, 'update'])->middleware('auth:sanctum');
    
    // Delete product (requires authentication)
    Route::delete('/{id}', [ProductController::class, 'destroy'])->middleware('auth:sanctum');
});

// -------- Best Seller API Routes --------
Route::prefix('best-sellers')->group(function () {
    // Get best sellers by category or all
    // GET /api/best-sellers - all categories
    // GET /api/best-sellers/watches - specific category
    Route::get('/{category?}', [BestController::class, 'index']);
    
    // Get all best sellers (paginated)
    Route::get('all', [BestController::class, 'all']);
    
    // Get top rated products
    Route::get('top-rated', [BestController::class, 'topRated']);
    
    // Get trending products
    Route::get('trending', [BestController::class, 'trending']);
});

// -------- Best Table API Route --------
Route::get('/best-seller', [BestController::class, 'index']);

// -------- Register API --------
Route::post('/register', function(Request $request){
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'status' => true,
        'message' => 'User registered successfully',
        'access_token' => $token,
        'token_type' => 'Bearer',
        'user' => $user
    ]);
});

// -------- Login API --------~
Route::post('/login', function(Request $request){
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid credentials'
        ], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

 return response()->json([
    'status' => true,
    'message' => 'Login successful',
    'access_token' => $token,
    'token_type' => 'Bearer',
    'user' => $user,
    'role' => $user->role
]);
});

// -------- Authenticated user --------
Route::middleware('auth:sanctum')->get('/user', function(Request $request){
    return response()->json([
        'status' => true,
        'user' => $request->user()
    ]);
});

// -------- Logout API --------
Route::middleware('auth:sanctum')->post('/logout', function(Request $request){
    $request->user()->tokens()->delete();

    return response()->json([
        'status' => true,
        'message' => 'Logged out successfully'
    ]);
});

Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
    return response()->json([
        'user' => $request->user()
    ]);
});

Route::middleware('auth:sanctum')->get('/admin/dashboard', function(Request $request){
    if ($request->user()->role !== 'admin') {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized'
        ], 403);
    }

    return response()->json([
        'status' => true,
        'message' => 'Welcome Admin!',
        'user' => $request->user()
    ]);
});

