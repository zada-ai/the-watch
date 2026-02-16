<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Get all products
     */
    public function index()
    {
        $products = Product::where('active', true)->get();
        return response()->json([
            'success' => true,
            'data' => $products,
            'message' => 'Products retrieved successfully'
        ]);
    }

    /**
     * Get products by category
     */
    public function getByCategory($category)
    {
        $products = Product::where('category', $category)
            ->where('active', true)
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $products,
            'category' => $category,
            'count' => $products->count(),
            'message' => 'Products retrieved successfully'
        ]);
    }

    /**
     * Get single product
     */
    public function show($id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product,
            'message' => 'Product retrieved successfully'
        ]);
    }

    /**
     * Store a new product
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string|in:watches,headphones,airbuds',
            'price' => 'required|integer',
            'original_price' => 'nullable|integer',
            'description' => 'nullable|string',
            'images' => 'required|array',
            'colors' => 'nullable|array',
            'discount' => 'nullable|integer|between:0,100',
            'active' => 'nullable|boolean'
        ]);

        $product = Product::create($validated);

        return response()->json([
            'success' => true,
            'data' => $product,
            'message' => 'Product created successfully'
        ], 201);
    }

    /**
     * Update product
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'nullable|string',
            'category' => 'nullable|string|in:watches,headphones,airbuds',
            'price' => 'nullable|integer',
            'original_price' => 'nullable|integer',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'colors' => 'nullable|array',
            'discount' => 'nullable|integer|between:0,100',
            'active' => 'nullable|boolean'
        ]);

        $product->update($validated);

        return response()->json([
            'success' => true,
            'data' => $product,
            'message' => 'Product updated successfully'
        ]);
    }

    /**
     * Delete product
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }

    /**
     * Get featured products by category
     */
    public function featured($category = null)
    {
        $query = Product::where('active', true);
        
        if ($category) {
            $query->where('category', $category);
        }

        $products = $query->limit(6)->get();

        return response()->json([
            'success' => true,
            'data' => $products,
            'message' => 'Featured products retrieved successfully'
        ]);
    }
}
