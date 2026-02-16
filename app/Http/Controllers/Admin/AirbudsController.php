<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AirbudsProduct;
use Illuminate\Http\Request;

class AirbudsController extends Controller
{
    protected function parseImagesFromString($value)
    {
        if (is_array($value)) return $value;
        if (empty($value)) return [];
        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) return $decoded;
        return array_map('trim', explode(',', $value));
    }

    protected function parseColors($value)
    {
        if (is_array($value)) return $value;
        if (empty($value)) return [];

        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) return $decoded;

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

    public function index()
    {
        $items = AirbudsProduct::orderBy('created_at', 'desc')->paginate(15);
        return view('Admin.airbuds.index', compact('items'));
    }

    public function create()
    {
        return view('Admin.airbuds.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'orig_price' => 'nullable|integer|min:0',
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
                $path = $file->store('airbuds', 'public');
                $path = str_replace('\\', '/', $path);
                $images[] = $path;
            }
        }

        $colors = $this->parseColors($request->input('colors'));

        AirbudsProduct::create([
            'name' => $validated['name'],
            'category' => 'airbuds',
            'price' => $validated['price'],
            'orig_price' => $validated['orig_price'] ?? null,
            'discount' => $validated['discount'] ?? 0,
            'descri' => $validated['descri'] ?? null,
            'images' => $images,
            'colors' => $colors,
            'gender' => $validated['gender'] ?? null,
            'active' => $request->has('active'),
        ]);

        return redirect()->route('admin.airbuds.index')->with('success', 'Airbuds entry created');
    }

    public function edit(AirbudsProduct $airbud)
    {
        return view('Admin.airbuds.edit', ['item' => $airbud]);
    }

    public function update(Request $request, AirbudsProduct $airbud)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'orig_price' => 'nullable|integer|min:0',
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
                $path = $file->store('airbuds', 'public');
                $path = str_replace('\\', '/', $path);
                $images[] = $path;
            }
        }

        $colors = $this->parseColors($request->input('colors'));

        $airbud->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'orig_price' => $validated['orig_price'] ?? $airbud->orig_price,
            'discount' => $validated['discount'] ?? $airbud->discount,
            'descri' => $validated['descri'] ?? $airbud->descri,
            'images' => !empty($images) ? $images : ($airbud->images ?? []),
            'colors' => !empty($colors) ? $colors : ($airbud->colors ?? []),
            'gender' => $validated['gender'] ?? $airbud->gender,
            'active' => $request->has('active'),
        ]);

        return redirect()->route('admin.airbuds.index')->with('success', 'Airbud updated');
    }

    public function destroy(AirbudsProduct $airbud)
    {
        $airbud->delete();
        return redirect()->route('admin.airbuds.index')->with('success', 'Deleted');
    }
}
