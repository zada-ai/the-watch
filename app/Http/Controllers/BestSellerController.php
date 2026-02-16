<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BestSeller;

class BestSellerController extends Controller
{
    public function index()
    {
        $watches = BestSeller::where('category', 'watches')->where('active', true)->get();
        $headphones = BestSeller::where('category', 'headphones')->where('active', true)->get();
        $airbuds = BestSeller::where('category', 'airbuds')->where('active', true)->get();

        return view('user.home.cards.best-seller', compact('watches', 'headphones', 'airbuds'));
    }
}
