<?php

namespace App\Http\Controllers;

use App\Category;
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
        $pagination = 9;
        if (request()->category){
            $products = Product::with('categories')->whereHas('categories',function($query){
                $query->where('slug',request()->category);
            });
            $categories = Category::all();
            $categoryName = optional($categories->where('slug',request()->category)->first())->name;
        }else{
            $products = Product::where('featured',true);
            $categories = Category::all();
            $categoryName = 'オススメ商品';
        }

        //paginateを付け足す
        if (request()->sort =='low_high'){
            $products = $products->orderBy('price','asc')->paginate($pagination);
        }elseif (request()->sort=='high_low'){
            $products = $products->orderBy('price','desc')->paginate($pagination);
        }else{
            $products = $products->paginate($pagination);
        }
        return view('shop',compact(
            'products','categories','categoryName'
        ));
    }


    public function show($slug)
    {
        $product = Product::where('slug',$slug)->firstOrFail();
        $mightLikes = Product::where('slug','!=',$slug)->mightAlsoLike()->get();
        return view('product',compact('product','mightLikes'));
    }


}
