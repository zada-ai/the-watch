<?php

namespace App\Http\Controllers;

use App\Models\BestSeller;
use Illuminate\Http\Request;

class BestSellerViewController extends Controller
{
    public function index()
    {
        $watches = BestSeller::where('category', 'watches')->where('active', true)->get();
        $headphones = BestSeller::where('category', 'headphones')->where('active', true)->get();
        $airbuds = BestSeller::where('category', 'airbuds')->where('active', true)->get();

        return view('userView.home.cards.best-seller', compact('watches', 'headphones', 'airbuds'));
    }
}
