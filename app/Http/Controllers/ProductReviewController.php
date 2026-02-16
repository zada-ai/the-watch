<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ProductReviewController extends Controller
{
    // STORE REVIEW
    public function store(Request $request)
    {
        try {
            \Log::info('ProductReviewController.store request', $request->all());

            $validated = $request->validate([
                'name'         => 'required|string|max:255',
                'rating'       => 'required|integer|min:1|max:5',
                'review'       => 'required|string|max:1000',
                // accept any non-empty product_type (plural/singular differences handled by caller)
                'product_type' => 'required|string|max:100',
                'product_id'   => 'required|integer',
                'image'        => 'nullable|image|max:2048',
            ]);

            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')
                    ->store('reviews', 'public');
            }

            // Normalize product_type to canonical lowercase keys (helps consistency across UI)
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

            $pt = strtolower(trim($validated['product_type']));
            $validated['product_type'] = $map[$pt] ?? $pt;

            $review = Review::create($validated);

            // Provide full image URL in response for immediate frontend use
            $reviewArr = $review->toArray();
            if (!empty($reviewArr['image'])) {
                $reviewArr['image_url'] = asset('storage/' . ltrim($reviewArr['image'], '/'));
            } else {
                $reviewArr['image_url'] = null;
            }

            return response()->json([
                'success' => true,
                'message' => 'Review submitted successfully',
                'review' => $reviewArr
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::warning('Product review validation failed', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Product review store error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit review'
            ], 500);
        }
    }

    // LIST REVIEWS (PER PRODUCT)
    public function listByProduct(Request $request)
    {
        $request->validate([
            'product_type' => 'required|string',
            'product_id'   => 'required|integer',
        ]);

        $requested = trim((string) $request->input('product_type'));
        $productId = $request->input('product_id');

        $low = strtolower($requested);
        $candidates = [$low];
        $candidates[] = ucfirst($low);
        $candidates[] = ucfirst($low) . 'Product';
        $candidates[] = ucfirst($low) . 'sProduct';
        $candidates[] = ucfirst($low) . 'Page';
        $sing = rtrim($low, 's');
        $candidates[] = $sing;
        $candidates = array_unique(array_filter($candidates));

        $reviews = Review::whereIn('product_type', $candidates)
            ->where('product_id', $productId)
            ->latest()
            ->get()
            ->map(function ($r) {
                $arr = $r->toArray();
                if (!empty($arr['image'])) {
                    $arr['image_url'] = asset('storage/' . ltrim($arr['image'], '/'));
                } else {
                    $arr['image_url'] = null;
                }
                return $arr;
            });

        return response()->json($reviews);
    }
}
