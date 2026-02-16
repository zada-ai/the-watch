<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    // Index - List all reviews
    public function index()
    {
        $reviews = Review::latest()->paginate(10);
        return view('Admin.reviews.index', compact('reviews'));
    }

    // Create - Show form to add review
    public function create()
    {
        return view('Admin.reviews.create');
    }

    // Store - Save new review
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
            'product_name' => 'nullable|string|max:255',
            'product_type' => 'nullable|string|max:191',
            'product_id' => 'nullable|integer',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('reviews', 'public');
            $validated['image'] = $path;
        }

        // Normalize product_type to canonical lowercase key
        $map = [
            'product' => 'product', 'products' => 'product',
            'bestseller' => 'bestseller', 'bestsellers' => 'bestseller',
            'watches' => 'watches', 'watch' => 'watches', 'watchspage' => 'watches', 'watchespage' => 'watches',
            'wallets' => 'wallets', 'wallet' => 'wallets',
            'airbuds' => 'airbuds', 'airbud' => 'airbuds',
            'perfume' => 'perfume', 'perfumes' => 'perfume',
            'headphones' => 'headphones', 'headphone' => 'headphones',
            'toys' => 'toys', 'toy' => 'toys',
        ];

        $pt = strtolower(trim($validated['product_type'] ?? ''));
        // If admin selected a class-name like ToysProduct, try to convert
        if (str_ends_with($pt, 'product')) {
            $pt = str_replace('product', '', $pt);
            $pt = trim($pt);
        }
        $validated['product_type'] = $map[$pt] ?? $pt;

        Review::create($validated);

        return redirect()->route('admin.reviews.index')->with('success', 'Review added successfully!');
    }

    // Edit - Show form to edit review
    public function edit(Review $review)
    {
        return view('Admin.reviews.edit', compact('review'));
    }

    // Update - Update review
    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
            'product_name' => 'nullable|string|max:255',
            'product_type' => 'nullable|string|max:191',
            'product_id' => 'nullable|integer',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('reviews', 'public');
            $validated['image'] = $path;
        }

        // Normalize product_type similar to store
        $map = [
            'product' => 'product', 'products' => 'product',
            'bestseller' => 'bestseller', 'bestsellers' => 'bestseller',
            'watches' => 'watches', 'watch' => 'watches', 'watchspage' => 'watches', 'watchespage' => 'watches',
            'wallets' => 'wallets', 'wallet' => 'wallets',
            'airbuds' => 'airbuds', 'airbud' => 'airbuds',
            'perfume' => 'perfume', 'perfumes' => 'perfume',
            'headphones' => 'headphones', 'headphone' => 'headphones',
            'toys' => 'toys', 'toy' => 'toys',
        ];
        $pt = strtolower(trim($validated['product_type'] ?? ''));
        if (str_ends_with($pt, 'product')) {
            $pt = str_replace('product', '', $pt);
            $pt = trim($pt);
        }
        $validated['product_type'] = $map[$pt] ?? $pt;

        $review->update($validated);

        return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully!');
    }

    // Destroy - Delete review
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully!');
    }
}
