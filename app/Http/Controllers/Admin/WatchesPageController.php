<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WatchesPage;
use Illuminate\Http\Request;

class WatchesPageController extends Controller
{
    public function index()
    {
        $items = WatchesPage::orderBy('created_at', 'desc')->paginate(15);
        return view('Admin.watchespage.index', compact('items'));
    }

    public function create()
    {
        return view('Admin.watchespage.create');
    }

    protected function parseArrayField($value)
    {
        if (is_array($value)) return $value;
        if (empty($value)) return [];
        // try json
        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) return $decoded;
        // fallback comma separated
        return array_map('trim', explode(',', $value));
    }

    protected function parseColors($value)
    {
        if (is_array($value)) return $value;
        if (empty($value)) return [];

        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) return $decoded;

        // parse comma-separated key:value pairs like "black:#000000, silver:#c0c0c0"
        $pairs = array_map('trim', explode(',', $value));
        $out = [];
        foreach ($pairs as $p) {
            if (strpos($p, ':') !== false) {
                [$k, $v] = array_map('trim', explode(':', $p, 2));
                if ($k !== '') $out[$k] = $v;
            } elseif (preg_match('/^#?[0-9a-fA-F]{3,6}$/', $p)) {
                $hex = ltrim($p, '#');
                $out['color_' . substr($hex, 0, 6)] = '#' . $hex;
            }
        }
        return $out;
    }

    protected function parseImagesFromString($value)
    {
        if (is_array($value)) return $value;
        if (empty($value)) return [];
        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) return $decoded;
        return array_map('trim', explode(',', $value));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'orig_price' => 'nullable|integer|min:0',
            'sale_price' => 'nullable|integer|min:0',
            'discount' => 'nullable|integer|min:0|max:100',
            'descri' => 'nullable|string',
            'images_text' => 'nullable|string',
            'image_files' => 'nullable|array',
            'image_files.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'colors' => 'nullable|string',
            'gender' => 'nullable|in:men,women,unisex',
            'active' => 'sometimes|in:0,1,on,true,false',
        ]);

        // images: support uploaded files (image_files[]) and a text field images_text
        $images = $this->parseImagesFromString($request->input('images_text'));
        if ($request->hasFile('image_files')) {
            foreach ($request->file('image_files') as $file) {
                if (!$file->isValid()) continue;
                $path = $file->store('watchespage', 'public');
                $path = str_replace('\\', '/', $path);
                $images[] = $path;
            }
        }

        $colors = $this->parseColors($request->input('colors'));

        $data = [
            'name' => $validated['name'],
            'category' => $validated['category'] ?? 'watches',
            'orig_price' => $validated['orig_price'] ?? 0,
            'sale_price' => $validated['sale_price'] ?? 0,
            'discount' => $validated['discount'] ?? 0,
            'descri' => $validated['descri'] ?? null,
            'images' => $images,
            'colors' => $colors,
            'gender' => $validated['gender'] ?? 'men',
            'active' => $request->has('active'),
        ];

        WatchesPage::create($data);

        return redirect()->route('admin.watchespage.index')->with('success', 'Watches entry created');
    }

    public function edit(WatchesPage $watchespage)
    {
        return view('Admin.watchespage.edit', ['item' => $watchespage]);
    }

    public function update(Request $request, WatchesPage $watchespage)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'orig_price' => 'nullable|integer|min:0',
            'sale_price' => 'nullable|integer|min:0',
            'discount' => 'nullable|integer|min:0|max:100',
            'descri' => 'nullable|string',
            'images_text' => 'nullable|string',
            'image_files' => 'nullable|array',
            'image_files.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'colors' => 'nullable|string',
            'gender' => 'nullable|in:men,women,unisex',
            'active' => 'sometimes|in:0,1,on,true,false',
        ]);

        $images = $this->parseImagesFromString($request->input('images_text'));
        if ($request->hasFile('image_files')) {
            foreach ($request->file('image_files') as $file) {
                if (!$file->isValid()) continue;
                $path = $file->store('watchespage', 'public');
                $path = str_replace('\\', '/', $path);
                $images[] = $path;
            }
        }

        $colors = $this->parseColors($request->input('colors'));

        $data = [
            'name' => $validated['name'],
            'category' => $validated['category'] ?? $watchespage->category,
            'orig_price' => $validated['orig_price'] ?? $watchespage->orig_price,
            'sale_price' => $validated['sale_price'] ?? $watchespage->sale_price,
            'discount' => $validated['discount'] ?? $watchespage->discount,
            'descri' => $validated['descri'] ?? $watchespage->descri,
            'images' => !empty($images) ? $images : ($watchespage->images ?? []),
            'colors' => !empty($colors) ? $colors : ($watchespage->colors ?? []),
            'gender' => $validated['gender'] ?? $watchespage->gender,
            'active' => $request->has('active'),
        ];

        $watchespage->update($data);

        return redirect()->route('admin.watchespage.index')->with('success', 'Watches entry updated');
    }

    public function destroy(WatchesPage $watchespage)
    {
        $watchespage->delete();
        return redirect()->route('admin.watchespage.index')->with('success', 'Deleted');
    }
}
