<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::inRandomOrder()->take(8)->get();
        return view('shop',compact('products'));
    }


    public function show($slug)
    {
        $product = Product::where('slug',$slug)->firstOrFail();
        $mightLikes = Product::where('slug','!=',$slug)->mightAlsoLike()->get();
        return view('product',compact('product','mightLikes'));
    }


}
