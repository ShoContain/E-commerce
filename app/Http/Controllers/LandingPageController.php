<?php

namespace App\Http\Controllers;

use App\Product;
use DebugBar\DebugBar;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::inRandomOrder()->take(8)->get();
        return view('landing-page',compact('products'));
    }

}
