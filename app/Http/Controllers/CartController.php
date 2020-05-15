<?php

namespace App\Http\Controllers;

use App\Product;
use Darryldecode\Cart\Cart;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validation = Validator::make($request->all(),[
            'quantity'=>'required|numeric|between:1,4',
        ]);
        if($validation->fails()){
            session()->flash('errors',collect(['数量の変更に失敗しました']));
            return response()->json(['success'=>false],400);
        }
        \Cart::update($id,array(
            'quantity'=>array(
                'relative'=>false,
                'value'=>$request->quantity
            ),
        ));
        session()->flash('success_message','数量を変更しました');
        return response()->json(['success'=>true]);
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

    public function switchToWishList($id){
        //同じ商品がウィッシュリストに入ってないかチエック
        $item = app('wishList')->getContent()->filter(function ($value) use ($id){
            return $id === $value->id;
        });
        if($item->isNotEmpty()){
            return redirect()->route('cart.index')->with('info_message','既に同じ商品がウイッシュリストに入っています');
        }

        $item = \Cart::get($id);
        \Cart::remove($id);
        $saleCondition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'tax 10%',
            'type' => 'tax',
            'value' => '10%',
            'target'=>'total',
        ));
        \Cart::condition($saleCondition);
        app('wishList')->add($item->id,$item->name,$item->price,1)->associate('App\Product');
        return redirect()->route('cart.index')->with('success_message',' 商品をウイッシュリスト入れました！');

    }
}
