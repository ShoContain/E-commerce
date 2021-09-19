<?php

namespace App\Http\Controllers;


use App\Http\Requests\CheckoutRequest;
use App\Jobs\SendOrderPlacedEmail;
use App\Mail\OrderPlaced;
use App\Order;
use App\OrderProduct;
use App\Product;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Mail;


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
        if($this->CheckproductsStillInStock()){
            return back()->withErrors('申し訳ありません、選択された商品の在庫がありません');
        }

        $contents = \Cart::getContent()->map(function ($items) {
            return $items->model->slug . ',' . $items->quantity;
        })->values()->toJson();

        try {
            $charge = Stripe::charges()->create([
                'amount' => $this->getNumbers()->get('newTotal'),
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

            $order=$this->addToOrdersTable($request,null);

            //Mail::send(new OrderPlaced($order));
            //キューを使用,ジョブの実行はConfirmationController内で
            SendOrderPlacedEmail::dispatch($order);

            //データベースより数量を引く
            $this->decreaseQuantity();

            \Cart::clear();
            session()->forget('coupon');
            //支払い確認ページにリダイレクト
            return redirect('/thankyou')
                ->with('thankyou_message', 'お支払いありがとうございます、間も無くお支払い確認メールをお届けします');
        } catch (CardErrorException $e) {
            $this->addToOrdersTable($request,$e->getMessage());
            return back()->withErrors('エラー: ' . $e->getMessage());
        }
    }

    protected function addToOrdersTable($request,$error){
        //Order Tableに情報を追加
        $order = Order::create([
            'user_id'=>auth()->user()->id ??null,
            'billing_email'=>$request->email,
            'billing_name'=>$request->name,
            'billing_address'=>$request->address,
            'billing_city'=>$request->city,
            'billing_prefecture'=>$request->prefecture,
            'billing_postalcode'=>$request->postal_code,
            'billing_phone'=>$request->phone,
            'billing_name_on_card'=>$request->name_on_card,
            'billing_discount'=>$this->getNumbers()->get('discount'),
            'billing_discount_code'=>$this->getNumbers()->get('codeName'),
            'billing_subtotal'=>$this->getNumbers()->get('newSubTotal'),
            'billing_tax'=>$this->getNumbers()->get('newTax'),
            'billing_total'=>$this->getNumbers()->get('newTotal'),
            'error'=>$error,
        ]);

        //Order_Product Tableに情報を追加
        foreach (\Cart::getContent() as $item) {
            OrderProduct::create([
                'order_id'=>$order->id,
                'product_id'=>$item->model->id,
                'quantity'=>$item['quantity'],
            ]);
        }
        return $order;
    }

    public function getNumbers()
    {
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubTotal = \Cart::getSubTotal() - $discount;
        $newTax = floor($newSubTotal * self::tax);
        $newTotal = $newTax + $newSubTotal;
        $codeName = session()->get('coupon')['name']??null;

        return collect([
            'discount' => $discount,
            'newSubTotal' => $newSubTotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal,
            'codeName'=>$codeName,
        ]);
    }

    protected function decreaseQuantity(){
        foreach (\Cart::getContent() as $item) {
            $product = Product::find($item->model->id);
            //数量更新
            $product->update([
                'quantity'=>$product->quantity-$item['quantity'],
            ]);
        }
    }

    protected function CheckproductsStillInStock(){
        foreach (\Cart::getContent() as $item) {
            $product = Product::find($item->model->id);
            //実際の在庫数と欲しい商品の在庫数を比較し、在庫がなければエラーメッセージ
            if($product->quantity<$item['quantity']){
                return true;
            }
        }
        return false;
}

}
