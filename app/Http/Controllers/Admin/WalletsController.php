<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WalletsProduct;
use Illuminate\Support\Str;

class WalletsController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $items = WalletsProduct::when($q, function($qry) use ($q){
            $qry->where('name', 'like', "%$q%");
        })->orderBy('id', 'desc')->paginate(20);

        return view('Admin.wallets.index', ['items' => $items]);
    }

    public function create()
    {
        return view('Admin.wallets.create');
    }

    protected function parseImages($req)
    {
        $images = [];
        if ($req->has('images_text') && !empty($req->images_text)) {
            $txt = $req->images_text;
            $try = json_decode($txt, true);
            if (is_array($try)) return $try;
            $parts = preg_split('/\s*,\s*/', $txt);
            return array_values(array_filter($parts));
        }
        return $images;
    }

    protected function normalizeUploadedPaths($files, $folder)
    {
        $stored = [];
        foreach($files as $f) {
            $path = $f->storePublicly($folder, 'public');
            $stored[] = str_replace('\\', '/', $path);
        }
        return $stored;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'orig_price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'descri' => 'nullable|string',
            'images_text' => 'nullable|string',
            'colors' => 'nullable|string',
            'gender' => 'nullable|in:men,women,unisex',
        ]);

        $images = $this->parseImages($request);
        if ($request->hasFile('image_files')) {
            $uploaded = $this->normalizeUploadedPaths($request->file('image_files'), 'wallets');
            $images = array_merge($images, $uploaded);
        }

        $colors = [];
        if ($request->has('colors') && !empty($request->colors)) {
            $try = json_decode($request->colors, true);
            if (is_array($try)) $colors = $try;
            else {
                $pairs = preg_split('/\s*,\s*/', $request->colors);
                foreach($pairs as $p) {
                    if (strpos($p, ':') !== false) {
                        [$k,$v] = array_map('trim', explode(':', $p, 2));
                        $colors[$k] = $v;
                    } else {
                        $colors[$p] = $p;
                    }
                }
            }
        }

        $item = new WalletsProduct();
        $item->name = $data['name'];
        $item->price = $data['price'] ?? null;
        $item->orig_price = $data['orig_price'] ?? null;
        $item->discount = $data['discount'] ?? null;
        $item->descri = $data['descri'] ?? null;
        $item->images = $images;
        $item->colors = $colors;
        $item->gender = $data['gender'] ?? null;
        $item->active = $request->has('active') ? 1 : 0;
        $item->save();

        return redirect()->route('admin.wallets.index')->with('success', 'Wallet created');
    }

    public function edit($id)
    {
        $item = WalletsProduct::findOrFail($id);
        return view('Admin.wallets.edit', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $item = WalletsProduct::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'orig_price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'descri' => 'nullable|string',
            'images_text' => 'nullable|string',
            'colors' => 'nullable|string',
            'gender' => 'nullable|in:men,women,unisex',
        ]);

        $images = $this->parseImages($request);
        if ($request->hasFile('image_files')) {
            $uploaded = $this->normalizeUploadedPaths($request->file('image_files'), 'wallets');
            $images = array_merge($images, $uploaded);
        }

        $colors = [];
        if ($request->has('colors') && !empty($request->colors)) {
            $try = json_decode($request->colors, true);
            if (is_array($try)) $colors = $try;
            else {
                $pairs = preg_split('/\s*,\s*/', $request->colors);
                foreach($pairs as $p) {
                    if (strpos($p, ':') !== false) {
                        [$k,$v] = array_map('trim', explode(':', $p, 2));
                        $colors[$k] = $v;
                    } else {
                        $colors[$p] = $p;
                    }
                }
            }
        }

        $item->name = $data['name'];
        $item->price = $data['price'] ?? null;
        $item->orig_price = $data['orig_price'] ?? null;
        $item->discount = $data['discount'] ?? null;
        $item->descri = $data['descri'] ?? null;
        $item->images = $images;
        $item->colors = $colors;
        $item->gender = $data['gender'] ?? null;
        $item->active = $request->has('active') ? 1 : 0;
        $item->save();

        return redirect()->route('admin.wallets.index')->with('success', 'Wallet updated');
    }

    public function destroy($id)
    {
        $item = WalletsProduct::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.wallets.index')->with('success', 'Deleted');
    }
}
