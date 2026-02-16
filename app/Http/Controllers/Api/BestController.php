<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Best;

class BestController extends Controller
{
    public function index()
    {
        return response()->json([
            'watches' => Best::where('category','watch')->where('status',1)->get(),
            'headphones' => Best::where('category','headphone')->where('status',1)->get(),
            'airbuds' => Best::where('category','airbud')->where('status',1)->get(),
        ]);
    }
}

