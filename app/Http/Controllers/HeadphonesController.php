<?php

namespace App\Http\Controllers;

use App\Models\HeadphonesProduct;
use Illuminate\Http\Request;

class HeadphonesController extends Controller
{
    public function index(Request $request)
    {
        $gender = $request->query('gender'); // 'men' or 'women' or null for all
        
        $query = HeadphonesProduct::where('active', true);
        
        if ($gender && in_array($gender, ['men', 'women'])) {
            $query->where('gender', $gender);
        }
        
        $products = $query->orderBy('created_at', 'desc')->paginate(36);
        
        return view('UserView.Home.headphones', compact('products'));
    }
}
