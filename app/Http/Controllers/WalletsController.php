<?php

namespace App\Http\Controllers;

use App\Models\WalletsProduct;
use Illuminate\Http\Request;

class WalletsController extends Controller
{
    public function index(Request $request)
    {
        $gender = $request->query('gender');
        
        $query = WalletsProduct::where('active', true);
        
        if ($gender && in_array($gender, ['men', 'women'])) {
            $query->where('gender', $gender);
        }
        
        $products = $query->orderBy('created_at', 'desc')->paginate(24);
        
        return view('UserView.Home.wallets', compact('products'));
    }
}
