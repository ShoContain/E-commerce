<?php

namespace App\Http\Controllers;

use App\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mightLikes = Product::mightAlsoLike()->get();
        return view('cart',compact('mightLikes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = \Cart::getContent()->filter(function ($value) use ($request){
           return $request->id === $value->id;
        });
        if($item->isNotEmpty()){
            return redirect()->route('cart.index')->with('info_message','既に同じ商品がカートに入っています');
        }
        else{
            $saleCondition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'tax 10%',
            'type' => 'tax',
            'value' => '10%',
            'target'=>'total',
        ));
        \Cart::condition($saleCondition);
        \Cart::add($request->id,$request->name,$request->price,1)->associate('App\Product');
        return redirect()->route('cart.index')->with('success_message','カートに入れました');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Cart::remove($id);
        return back()->with('success_message','商品をカートから削除しました');
    }
}
