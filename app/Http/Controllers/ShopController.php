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

        //paginateする
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

        //在庫状態
        $stock=$product->quantity;
        if($stock>=5){
            $stock_level='在庫あり';
            $stock_tag = 'stock_available';
        }elseif ($stock<5&&$stock>0){
            $stock_level = '在庫 残り'.$stock.'点';
            $stock_tag = 'stock_few_left';
        }else{
            $stock_level='在庫なし';
            $stock_tag = 'stock_unavailable';
        }

        return view('product',compact('product','mightLikes','stock_level','stock_tag'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'query'=>'required|min:3',
        ]);
        $query = $request->input('query');

        //Searchableパッケージで全文検索をかける
        $products = Product::search($query)->paginate(9);
//        name,details,descriptionのどれかを検索対象
//        $products = Product::where('name','like',"%$query%")
//            ->orWhere('details','like',"%$query%")
//            ->orWhere('description','like',"%$query%")
//            ->paginate(9);

        return view('search-result',compact('products'));
    }
}
