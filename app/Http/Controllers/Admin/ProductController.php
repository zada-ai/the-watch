<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('Admin.Products.index', compact('products'));
    }

    public function create()
    {
        $categories = ['watches', 'headphones', 'airbuds'];
        return view('Admin.Products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:watches,headphones,airbuds',
            'price' => 'required|integer|min:1',
            'original_price' => 'nullable|integer|min:1',
            'description' => 'nullable|string',
            'discount' => 'nullable|integer|min:0|max:100',
            'colors' => 'nullable|string',
            'images' => 'nullable|string',
            'active' => 'nullable|boolean',
        ]);

        // Parse colors and images (comma-separated)
        $validated['colors'] = $validated['colors'] ? array_map('trim', explode(',', $validated['colors'])) : [];
        $validated['images'] = $validated['images'] ? array_map('trim', explode(',', $validated['images'])) : [];
        $validated['active'] = $request->has('active');

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = ['watches', 'headphones', 'airbuds'];
        return view('Admin.Products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:watches,headphones,airbuds',
            'price' => 'required|integer|min:1',
            'original_price' => 'nullable|integer|min:1',
            'description' => 'nullable|string',
            'discount' => 'nullable|integer|min:0|max:100',
            'colors' => 'nullable|string',
            'images' => 'nullable|string',
            'active' => 'nullable|boolean',
        ]);

        // Parse colors and images
        $validated['colors'] = $validated['colors'] ? array_map('trim', explode(',', $validated['colors'])) : [];
        $validated['images'] = $validated['images'] ? array_map('trim', explode(',', $validated['images'])) : [];
        $validated['active'] = $request->has('active');

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
