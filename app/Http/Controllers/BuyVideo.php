<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuyVideo as BuyVideoModel;
use Illuminate\Support\Facades\Storage;

class BuyVideo extends Controller
{
    // Admin form view for uploading buy-only videos
    public function adminForm()
    {
        return view('Admin.BuyVideo.index');
    }

    // Store uploaded video for a product
    public function store(Request $request)
    {
        $request->validate([
            'product'     => 'required|string',
            'product_id'  => 'required|integer',
            'video_file'  => 'required|mimetypes:video/mp4,video/quicktime,video/x-msvideo|max:51200',
        ]);

        $file = $request->file('video_file');
        $path = $file->store('products/videos', 'public');

        $record = BuyVideoModel::create([
            'product_type' => $request->input('product'),
            'product_id'   => $request->input('product_id'),
            'video_path'   => 'storage/' . $path,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['uploaded' => $record], 201);
        }

        return redirect()->back()->with('status', 'Video uploaded');
    }

    // List videos; can filter by product_type and product_id
    public function index(Request $request)
    {
        $query = BuyVideoModel::query();
        if ($request->filled('product_type')) {
            $query->where('product_type', $request->input('product_type'));
        }
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->input('product_id'));
        }

        return response()->json($query->get());
    }

    // Delete a buy video (admin)
    public function destroy($id)
    {
        $v = BuyVideoModel::findOrFail($id);

        if ($v->video_path) {
            $storedPath = preg_replace('#^storage/#', '', $v->video_path);
            if (Storage::disk('public')->exists($storedPath)) {
                Storage::disk('public')->delete($storedPath);
            }
        }

        $v->delete();

        return response()->json(['deleted' => true]);
    }
}
