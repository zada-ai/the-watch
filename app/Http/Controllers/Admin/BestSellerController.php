<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BestSeller;
use Illuminate\Http\Request;

class BestSellerController extends Controller
{
    // Show all best sellers
    public function index()
    {
        $bestsellers = BestSeller::orderBy('created_at', 'desc')->paginate(10);
        $categories = ['watches', 'headphones', 'airbuds'];
        return view('admin.bestseller.index', compact('bestsellers', 'categories'));
    }

    // Show create form
    public function create()
    {
        $categories = ['watches', 'headphones', 'airbuds'];
        return view('admin.bestseller.create', compact('categories'));
    }

    // Store new best seller
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'descri' => 'required|string|max:500',
            'orig_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0|max:100',
            'category' => 'required|in:watches,headphones,airbuds',
            'active' => 'boolean',
            'colors' => 'required|array|min:1',
            'colors.*' => 'string',
            'color_codes.*' => 'required|string',
        ]);

        // Process colors - create { colorName: hexCode } object
        $colors = [];
        if (!empty($request->colors)) {
            foreach ($request->colors as $index => $colorName) {
                $colors[$colorName] = $request->color_codes[$index] ?? '#000000';
            }
        }

        // Process images - grouped by color { colorName: [urls] }
        $images = [];
        foreach ($request->colors as $colorIndex => $colorName) {
            $images[$colorName] = [];
            
            // Check if there are files for this color index
            $colorKey = 'images_color_' . $colorIndex;
            if ($request->hasFile($colorKey)) {
                foreach ($request->file($colorKey) as $file) {
                    $path = $file->store('best-seller-assets', 'public');
                    $images[$colorName][] = asset('storage/' . $path);
                }
            }
        }

        BestSeller::create([
            'name' => $validated['name'],
            'descri' => $validated['descri'],
            'orig_price' => $validated['orig_price'],
            'sale_price' => $validated['sale_price'],
            'discount' => $validated['discount'],
            'category' => $validated['category'],
            'active' => $request->has('active'),
            'colors' => $colors,
            'images' => $images,
        ]);

        return redirect()->route('admin.bestseller.index')->with('success', 'Best Seller created successfully!');
    }

    // Show edit form
    public function edit(BestSeller $bestseller)
    {
        $categories = ['watches', 'headphones', 'airbuds'];
        return view('admin.bestseller.edit', compact('bestseller', 'categories'));
    }

    // Update best seller
    public function update(Request $request, BestSeller $bestseller)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'descri' => 'required|string|max:500',
            'orig_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0|max:100',
            'category' => 'required|in:watches,headphones,airbuds',
            'active' => 'boolean',
            'colors' => 'required|array|min:1',
            'colors.*' => 'string',
            'color_codes.*' => 'required|string',
        ]);

        // Process colors
        $colors = [];
        if (!empty($request->colors)) {
            foreach ($request->colors as $index => $colorName) {
                $colors[$colorName] = $request->color_codes[$index] ?? '#000000';
            }
        }

        // Process images - grouped by color, keep existing if not replaced
        $images = $bestseller->images ?? [];
        foreach ($request->colors as $colorIndex => $colorName) {
            if (!isset($images[$colorName])) {
                $images[$colorName] = [];
            }
            
            $colorKey = 'images_color_' . $colorIndex;
            if ($request->hasFile($colorKey)) {
                $images[$colorName] = [];
                foreach ($request->file($colorKey) as $file) {
                    $path = $file->store('best-seller-assets', 'public');
                    $images[$colorName][] = asset('storage/' . $path);
                }
            }
        }

        $bestseller->update([
            'name' => $validated['name'],
            'descri' => $validated['descri'],
            'orig_price' => $validated['orig_price'],
            'sale_price' => $validated['sale_price'],
            'discount' => $validated['discount'],
            'category' => $validated['category'],
            'active' => $request->has('active'),
            'colors' => $colors,
            'images' => $images,
        ]);

        return redirect()->route('admin.bestseller.index')->with('success', 'Best Seller updated successfully!');
    }

    // Delete best seller
    public function destroy(BestSeller $bestseller)
    {
        $bestseller->delete();
        return redirect()->route('admin.bestseller.index')->with('success', 'Best Seller deleted successfully!');
    }

    // Toggle active status
    public function toggleActive(BestSeller $bestseller)
    {
        $bestseller->update(['active' => !$bestseller->active]);
        return back()->with('success', 'Status updated!');
    }
}
