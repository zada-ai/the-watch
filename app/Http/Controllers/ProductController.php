<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function exclusiveCollections(Request $request)
    {
        $watches = Product::where('category', 'watches')->where('active', 1)->get();
        $headphones = Product::where('category', 'headphones')->where('active', 1)->get();
        $airbuds = Product::where('category', 'airbuds')->where('active', 1)->get();

        // Ensure image URLs are asset()'ed so JS can use them directly
        $all = $watches->concat($headphones)->concat($airbuds);
        $productImages = $all->mapWithKeys(function ($p) {
            $imgs = $p->images ?: [];
            $imgs = array_map(function ($i) {
                if (is_string($i) && (str_starts_with($i, 'http://') || str_starts_with($i, 'https://') || str_starts_with($i, '/'))) {
                    return $i;
                }
                return asset($i);
            }, $imgs);
            return [$p->id => $imgs];
        })->toArray();

        return view('UserView.Home.exclusive', compact('watches', 'headphones', 'airbuds', 'productImages'));
    }
}
