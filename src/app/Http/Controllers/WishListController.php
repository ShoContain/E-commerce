<?php

namespace App\Http\Controllers;

use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class WishListController extends Controller
{


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        app('wishList')->remove($id);
        return back()->with('success_message','商品をウイッシュリストから削除しました');
    }

//    ウイッシュリストからカートに商品を移動
    public function switchToCart($id)
    {
        //同じ商品がカートに入ってないかチエック
        $item = \Cart::getContent()->filter(function ($value) use ($id) {
            return $id === $value->id;
        });
        if ($item->isNotEmpty()) {
            return redirect()->route('cart.index')->with('info_message', '既に同じ商品がカートに入っています');
        } else {
            //ウィッシュリストの商品を削除
            $wishListItem = app('wishList')->get($id);
            app('wishList')->remove($id);

            //条件を設定
            $saleCondition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'tax 10%',
                'type' => 'tax',
                'value' => '10%',
                'target' => 'total',
            ));
            \Cart::condition($saleCondition);
//            カートに保存
            \Cart::add($wishListItem->id, $wishListItem->name, $wishListItem->price, 1)->associate('App\Product');
            return redirect()->route('cart.index')->with('success_message', ' 商品をカートに入れました！');
        }
    }
}
