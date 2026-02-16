<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Store review
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
            'product_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('reviews', 'public');
            $validated['image'] = $path;
        }

        Review::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your review has been posted.'
        ]);
    }

    // Get all reviews
    public function getAll()
    {
        $reviews = Review::latest()->get();
        return response()->json($reviews);
    }
}
