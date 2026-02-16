<?php

namespace App\Http\Controllers;

use App\Models\WatchesPage;
use Illuminate\Http\Request;

class WatchesPageController extends Controller
{
    public function index(Request $request)
    {
        $query = WatchesPage::where('active', true)
            ->where('category', 'watches');

        // Optional gender filter: men, women, unisex
        $gender = $request->query('gender');
        if (in_array($gender, ['men', 'women', 'unisex'])) {
            $query->where('gender', $gender);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(48);

        return view('UserView.Home.watches', compact('products'));
    }
}
