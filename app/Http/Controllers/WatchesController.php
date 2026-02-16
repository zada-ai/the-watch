<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WatchesController extends Controller
{
    public function index(Request $request)
    {
        $gender = $request->query('gender'); // 'men' or 'women' or null for all
        
        $query = Product::where('category', 'watches')->where('active', true);
        
        if ($gender && in_array($gender, ['men', 'women'])) {
            $query->where('gender', $gender);
        }
        
        $products = $query->orderBy('created_at', 'desc')->paginate(48);
        
        return view('UserView.Home.watches', compact('products'));
    }
}
