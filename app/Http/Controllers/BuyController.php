<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\BestSeller;
use App\Models\BuyImage;
use App\Models\BuyVideo;

use App\Models\WalletsPage;
use App\Models\AirbudsProduct;
use App\Models\HeadphonesProduct;
use App\Models\PerfumeProduct;



class BuyController extends Controller
{
    public function buy(Request $request)
    {
        $id = $request->query('id');
        $type = $request->query('type'); 

        if (!$id) {
            abort(404, 'Product ID is required');
        }

        // Normalize type and use a model map (case-insensitive)
        $typeKey = strtolower(trim((string) ($type ?? '')));

        $modelMap = [
            'product' => Product::class,
            'bestseller' => BestSeller::class,
            'watches' => \App\Models\WatchesPage::class,
            'wallets' => \App\Models\WalletsProduct::class,
            'airbuds' => AirbudsProduct::class,
            'perfume' => PerfumeProduct::class,
            'headphones' => HeadphonesProduct::class,
            'toys' => \App\Models\ToysProduct::class,
        ];

        $model = null;
        if ($typeKey !== '' && isset($modelMap[$typeKey])) {
            $modelClass = $modelMap[$typeKey];
            $model = $modelClass::findOrFail($id);
        } else {
            // Backwards-compatible fallback: try BestSeller first, then Product
            $model = BestSeller::find($id);
            if (!$model) {
                $model = Product::find($id);
            }
            if (!$model) {
                abort(404, 'Product not found');
            }
        }

        $product = $this->normalizeModel($model);
        
        // Determine product type for reviews
        $productType = strtolower($typeKey ?: 'product');

        return view('UserView.Home.buy', compact('product', 'type', 'productType'));
    }

    /**
     * Normalize different model shapes into a unified stdClass for the buy view.
     */
protected function normalizeModel($model)
{
    $attrs = is_object($model) && method_exists($model, 'toArray') ? $model->toArray() : (array) $model;

    $out = new \stdClass();
    $out->id = $attrs['id'] ?? ($model->id ?? null);
    $out->name = $attrs['name'] ?? 'Product';
    
    // ✅ Ensure description always exists
    $out->description = $attrs['descri'] 
        ?? $attrs['description'] 
        ?? $attrs['short_description'] 
        ?? ($model->descri ?? '')
        ?? ($model->description ?? '');

    // Prices
    $out->price = $attrs['price'] ?? ($model->price ?? 0);
    $out->sale_price = $attrs['sale_price'] ?? ($model->sale_price ?? $out->price);
    $out->orig_price = $attrs['orig_price'] ?? ($model->orig_price ?? $out->price);

    // Discount calculation
    $out->discount = $attrs['discount'] ?? ($model->discount ?? 0);
    if (!$out->discount && $out->orig_price > 0 && $out->sale_price > 0 && $out->orig_price > $out->sale_price) {
        $out->discount = round((($out->orig_price - $out->sale_price) / $out->orig_price) * 100);
    }

    // Images
    $rawImages = $attrs['images'] ?? ($model->images ?? null);
    if (is_string($rawImages)) {
        $decoded = json_decode($rawImages, true);
        $out->images = is_array($decoded) ? $decoded : [$rawImages];
    } elseif (is_array($rawImages)) {
        $out->images = $rawImages;
    } else {
        $out->images = []; // default empty
    }

    // Colors
    $rawColors = $attrs['colors'] ?? ($model->colors ?? []);
    if (is_string($rawColors)) {
        $decoded = json_decode($rawColors, true);
        $out->colors = is_array($decoded) ? $decoded : [];
    } elseif (is_array($rawColors)) {
        $out->colors = $rawColors;
    } else {
        $out->colors = [];
    }

    // Video & reviews
    $out->video = $attrs['video'] ?? ($model->video ?? null);
    $out->reviews = $attrs['reviews'] ?? ($model->reviews ?? []);
    $out->product_type = class_basename($model);

    // Buy-only images uploaded via admin dashboard
    $out->buy_images = [];
    if (is_object($model) && isset($model->id)) {
        $productType = class_basename($model);

        $out->buy_images = BuyImage::where('product_id', $model->id)
            ->where('product_type', $productType)
            ->pluck('image_path')
            ->toArray();

        // Ensure each buy image path is an absolute URL for browser consumption
        $out->buy_images = array_map(function($p) {
            if (empty($p)) return $p;
            // If already absolute, leave it
            if (preg_match('#^https?://#i', $p)) return $p;
            // If path already starts with a slash, use asset directly
            if (strpos($p, '/') === 0) {
                return asset(ltrim($p, '/'));
            }
            return asset($p);
        }, $out->buy_images);
        
        // Also check for admin-uploaded buy-only videos and prefer them over model video
        $buyVideos = BuyVideo::where('product_id', $model->id)
            ->where('product_type', $productType)
            ->pluck('video_path')
            ->toArray();

        if (!empty($buyVideos)) {
            $v = $buyVideos[0];
            if (!empty($v)) {
                if (preg_match('#^https?://#i', $v)) {
                    $out->video = $v;
                } elseif (strpos($v, '/') === 0) {
                    $out->video = asset(ltrim($v, '/'));
                } else {
                    $out->video = asset($v);
                }
            }
        }
    }

    return $out;
}


}

