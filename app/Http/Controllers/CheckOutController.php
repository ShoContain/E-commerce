<?php

namespace App\Http\Controllers;


use App\Http\Requests\CheckoutRequest;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkout');
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
    public function store(CheckoutRequest $request)
    {
        $contents = \Cart::getContent()->map(function ($items){
            return $items->model->slug.','.$items->quantity;
        })->values()->toJson();

        try {
            $charge = Stripe::charges()->create([
                'amount'=>\Cart::getTotal()/100,
                'currency'=>'jpy',
                'source' => $request->stripeToken,
                'description'=>'Chargeテスト',
                'receipt_email'=>$request->email,
                'metadata'=>[
                    'contents'=>$contents,
                    'quantity'=>\Cart::getContent()->count(),
                ],
            ]);
            \Cart::clear();
            //支払い確認ページにリダイレクト
            return redirect('/thankyou')
                ->with('thankyou_message','お支払いありがとうございます、間も無くお支払い確認メールをお届けします');
        }catch (CardErrorException $e){
            return back()->withErrors('エラー: '.$e->getMessage());
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
        //
    }
}
