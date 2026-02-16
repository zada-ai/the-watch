<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BuyImage as BuyImageModel;
use Illuminate\Support\Facades\Storage;

class BuyImage extends Controller
{
    // Admin: upload buy-only images for a specific product/card
    public function store(Request $request)
    {
        $request->validate([
            'product'      => 'required|string',  // Class name like "Product", "BestSeller", etc.
            'product_id'   => 'required|integer',
            'buy_images'   => 'required',
            'buy_images.*' => 'image|max:5120',
        ]);

        $created = [];
        $files = $request->file('buy_images', []);
        $productType = $request->input('product');  // Already just the class name from the form
        
        foreach ($files as $img) {
            $path = $img->store('products/buy', 'public');

            $record = BuyImageModel::create([
                'product_type' => $productType,
                'product_id'   => $request->input('product_id'),
                'image_path'   => 'storage/' . $path,
            ]);

            $created[] = $record;
        }

        if ($request->wantsJson()) {
            return response()->json(['uploaded' => $created], 201);
        }

        return redirect()->back()->with('status', 'Images uploaded');
    }

    // List buy images; can filter by product_type and product_id
    public function index(Request $request)
    {
        $query = BuyImageModel::query();
        if ($request->filled('product_type')) {
            $query->where('product_type', $request->input('product_type'));
        }
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->input('product_id'));
        }

        return response()->json($query->get());
    }

    // Admin form view for uploading buy-only images
    public function adminForm()
    {
        return view('Admin.BuyImage.index');
    }

    // Delete a buy image (admin)
    public function destroy($id)
    {
        $img = BuyImageModel::findOrFail($id);

        // attempt to delete file from storage
        if ($img->image_path) {
            $storedPath = preg_replace('#^storage/#', '', $img->image_path);
            if (Storage::disk('public')->exists($storedPath)) {
                Storage::disk('public')->delete($storedPath);
            }
        }

        $img->delete();

        return response()->json(['deleted' => true]);
    }
}
