<?php

namespace App\Http\Controllers;

use App\Models\ToysProduct;
use Illuminate\Http\Request;

class ToysController extends Controller
{
    public function index(Request $request)
    {
        $gender = $request->query('gender');
        
        $query = ToysProduct::where('active', true);
        
        if ($gender && in_array($gender, ['men', 'women'])) {
            $query->where('gender', $gender);
        }
        
        $products = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('UserView.Home.toys', compact('products'));
    }
}
