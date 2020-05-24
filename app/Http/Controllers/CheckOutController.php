<?php

namespace App\Http\Controllers;


use App\Http\Requests\CheckoutRequest;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;


class CheckOutController extends Controller
{
//    税率
    const tax = 10 / 100;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Cart::getTotal()==0){
            return redirect()->route('shop.index');
        }
        if(auth()->user() && request()->is('guestCheckout')){
            return redirect()->route('checkout.index');
        }

        $discount = $this->getNumbers()->get('discount');
        $newSubTotal = $this->getNumbers()->get('newSubTotal');
        $newTax = $this->getNumbers()->get('newTax');
        $newTotal = $this->getNumbers('newTotal')->get('newTotal');
        return view('checkout', compact([
            'newSubTotal', 'discount', 'newTax', 'newTotal'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        $contents = \Cart::getContent()->map(function ($items) {
            return $items->model->slug . ',' . $items->quantity;
        })->values()->toJson();

        try {
            $charge = Stripe::charges()->create([
                'amount' => $this->getNumbers()->get('newTotal') / 100,
                'currency' => 'jpy',
                'source' => $request->stripeToken,
                'description' => 'Chargeテスト',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => \Cart::getContent()->count(),
                    'discount' => collect(session()->get('coupon'))->toJson(),
                ],
            ]);
            \Cart::clear();
            //支払い確認ページにリダイレクト
            return redirect('/thankyou')
                ->with('thankyou_message', 'お支払いありがとうございます、間も無くお支払い確認メールをお届けします');
        } catch (CardErrorException $e) {
            return back()->withErrors('エラー: ' . $e->getMessage());
        }
    }

    public function getNumbers()
    {
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubTotal = \Cart::getSubTotal() - $discount;
        $newTax = floor($newSubTotal * self::tax);
        $newTotal = $newTax + $newSubTotal;

        return collect([
            'discount' => $discount,
            'newSubTotal' => $newSubTotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal,
        ]);
    }


}
