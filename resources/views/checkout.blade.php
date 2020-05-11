@extends('layout')

@section('title','お支払い')

@section('extra-css')

@endsection

@section('content')
    <div class="container">
        <div class="checkout-header">
            <svg fill="currentColor" width="40" height="70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M444.875 109.792L338.208 3.125c-2-2-4.708-3.125-7.542-3.125h-224C83.146 0 64 19.135 64 42.667v426.667C64 492.865 83.146 512 106.667 512h298.667c23.52 0 42.666-19.135 42.666-42.667v-352c0-2.833-1.125-5.541-3.125-7.541zM341.333 36.417l70.25 70.25h-48.917c-11.771 0-21.333-9.573-21.333-21.333V36.417zm85.334 432.916c0 11.76-9.563 21.333-21.333 21.333H106.667c-11.771 0-21.333-9.573-21.333-21.333V42.667c0-11.76 9.563-21.333 21.333-21.333H320v64C320 108.865 339.146 128 362.667 128h64v341.333z"/><path d="M373.333 298.667H138.667A10.66 10.66 0 00128 309.334a10.66 10.66 0 0010.667 10.667h234.667a10.66 10.66 0 0010.667-10.667 10.662 10.662 0 00-10.668-10.667zM373.333 234.667H138.667A10.66 10.66 0 00128 245.334a10.66 10.66 0 0010.667 10.667h234.667a10.66 10.66 0 0010.667-10.667 10.662 10.662 0 00-10.668-10.667zM373.333 362.667H138.667A10.66 10.66 0 00128 373.334a10.66 10.66 0 0010.667 10.667h234.667a10.66 10.66 0 0010.667-10.667 10.662 10.662 0 00-10.668-10.667zM266.667 426.667h-128A10.66 10.66 0 00128 437.334a10.66 10.66 0 0010.667 10.667h128a10.66 10.66 0 0010.667-10.667 10.662 10.662 0 00-10.667-10.667zM234.667 181.333A10.66 10.66 0 00245.334 192h128a10.66 10.66 0 0010.667-10.667 10.66 10.66 0 00-10.667-10.667h-128a10.662 10.662 0 00-10.667 10.667zM160 170.667h-21.333A10.66 10.66 0 00128 181.334a10.66 10.66 0 0010.667 10.667h10.667c0 5.896 4.771 10.667 10.667 10.667s10.667-4.771 10.667-10.667v-1.965C183.056 185.617 192 173.888 192 160c0-17.646-14.354-32-32-32-5.875 0-10.667-4.781-10.667-10.667 0-5.885 4.792-10.667 10.667-10.667h21.333c5.896 0 10.667-4.771 10.667-10.667s-4.771-10.667-10.667-10.667h-10.667c0-5.896-4.771-10.667-10.667-10.667s-10.667 4.771-10.667 10.667v1.965C136.944 91.716 128 103.445 128 117.333c0 17.646 14.354 32 32 32 5.875 0 10.667 4.781 10.667 10.667s-4.792 10.667-10.667 10.667z"/></svg>
            <h1 class="checkout-heading stylish-heading">お支払い</h1>
        </div>
        <div class="checkout-section">
            <div>
                <form action="#">
                <h2>お支払い情報</h2>
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" required>
                </div>
                <div class="form-group">
                    <label for="name">名前</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                </div>
                <div class="form-group">
                    <label for="address">住所</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}" required>
                </div>

                <div class="half-form">
                    <div class="form-group">
                        <label for="city">市・町・村</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="prefecture">都道府県</label>
                        <input type="text" class="form-control" id="prefecture" name="prefecture" value="{{old('prefecture')}}" required>
                    </div>
                </div> {{--end of half-form--}}

                <div class="half-form">
                    <div class="form-group">
                        <label for="postal-code">郵便番号</label>
                        <input type="text" class="form-control" id="postal-code" name="postal-code" value="{{old('postal-code')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">電話番号</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}" required>
                    </div>
                </div> {{--end of half-form--}}

                <h2>お支払い方法</h2>
                <div class="form-group">
                    <label for="name_on_card">クレジット氏名</label>
                    <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="">
                </div>

                <div class="form-group">
                    <label for="number_on_card_on_card">クレジット番号</label>
                    <input type="text" class="form-control" id="number_on_card" name="number_on_card" value="">
                </div>

                <div class="half-form">
                    <div class="form-group">
                        <label for="expiry">有効期限</label>
                        <input type="text" class="form-control" id="expiry" name="expiry" value="" placeholder="MM/DD">
                    </div>
                    <div class="form-group">
                        <label for="cvc">CVC</label>
                        <input type="text" class="form-control" id="cvc" name="cvc" value="">
                    </div>
                </div> {{--end of half-form--}}

                    <button type="submit" class="button-primary full-width">支払いを完了する</button>
                </form>
            </div>

            <div class="checkout-table-container">
                <h2>注文商品詳細</h2>
                <div class="checkout-table">
                    @foreach(Cart::getContent() as $item)
                    <div class="checkout-table-row">
                        <div class="checkout-table-left">
                            <img src="{{ asset('img/products/'.$item->model->slug.'.jpg') }}" alt="" class="checkout-table-image">
                            <div class="checkout-item-details">
                                <div class="checkout-table-name">{{ $item->model->name }}</div>
                                <div class="checkout-table-detail">{{ $item->model->details }}</div>
                                <div class="checkout-table-price">{{ presentPrice($item->model->price) }}</div>
                            </div>
                        </div>
                        <div class="checkout-table-right">
                            <div class="checkout-item-quantity">
                                1
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>  {{--end of checkout-table--}}

                <div class="checkout-total">
                    <div class="checkout-total-left">
                        小計 <br>
                        税（10%）<br>
                        <span class="checkout-total-span">合計(税込)</span> <br>
                    </div>

                    <div class="checkout-total-right">
                        {{ presentPrice(Cart::getSubTotal()) }} <br>
                        {{ getTax(Cart::getSubTotal()) }} <br>
                        <span class="checkout-total-span">{{ presentPrice(Cart::getTotal()) }}</span> <br>
                    </div>

                </div> {{--end of checkout-total--}}
            </div> {{--end of checkout-table-container --}}
        </div> {{--end of checkout-section--}}
    </div>
@endsection
