<?php

namespace App\Http\Controllers;

use App\Models\AirbudsProduct;
use Illuminate\Http\Request;

class AirbudsController extends Controller
{
    public function index(Request $request)
    {
        $gender = $request->query('gender'); // 'men' or 'women' or null for all
        
        $query = AirbudsProduct::where('active', true);
        
        if ($gender && in_array($gender, ['men', 'women'])) {
            $query->where('gender', $gender);
        }
        
        $products = $query->orderBy('created_at', 'desc')->paginate(24);
        
        return view('UserView.Home.airbuds', compact('products'));
    }
}
