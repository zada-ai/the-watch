<?php

namespace App\Http\Controllers;

use App\Models\PerfumeProduct;
use Illuminate\Http\Request;

class PerfumeController extends Controller
{
    public function index(Request $request)
    {
        $gender = $request->query('gender');
        
        $query = PerfumeProduct::where('active', true);
        
        if ($gender && in_array($gender, ['men', 'women'])) {
            $query->where('gender', $gender);
        }
        
        $products = $query->orderBy('created_at', 'desc')->paginate(24);
        
        return view('UserView.Home.perfume.index', compact('products'));
    }
}
