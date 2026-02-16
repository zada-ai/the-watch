<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the user homepage.
     */
    public function index()
    {
        return view('UserView.Home.Homepage');
    }
}
