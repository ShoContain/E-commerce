@extends('layout')

@section('title','お支払い')

@section('extra-css')
    {{--ストライプJS--}}
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
    <div class="container">
        @if(session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="checkout-header">
            <svg fill="currentColor" width="40" height="70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path
                    d="M444.875 109.792L338.208 3.125c-2-2-4.708-3.125-7.542-3.125h-224C83.146 0 64 19.135 64 42.667v426.667C64 492.865 83.146 512 106.667 512h298.667c23.52 0 42.666-19.135 42.666-42.667v-352c0-2.833-1.125-5.541-3.125-7.541zM341.333 36.417l70.25 70.25h-48.917c-11.771 0-21.333-9.573-21.333-21.333V36.417zm85.334 432.916c0 11.76-9.563 21.333-21.333 21.333H106.667c-11.771 0-21.333-9.573-21.333-21.333V42.667c0-11.76 9.563-21.333 21.333-21.333H320v64C320 108.865 339.146 128 362.667 128h64v341.333z"/>
                <path
                    d="M373.333 298.667H138.667A10.66 10.66 0 00128 309.334a10.66 10.66 0 0010.667 10.667h234.667a10.66 10.66 0 0010.667-10.667 10.662 10.662 0 00-10.668-10.667zM373.333 234.667H138.667A10.66 10.66 0 00128 245.334a10.66 10.66 0 0010.667 10.667h234.667a10.66 10.66 0 0010.667-10.667 10.662 10.662 0 00-10.668-10.667zM373.333 362.667H138.667A10.66 10.66 0 00128 373.334a10.66 10.66 0 0010.667 10.667h234.667a10.66 10.66 0 0010.667-10.667 10.662 10.662 0 00-10.668-10.667zM266.667 426.667h-128A10.66 10.66 0 00128 437.334a10.66 10.66 0 0010.667 10.667h128a10.66 10.66 0 0010.667-10.667 10.662 10.662 0 00-10.667-10.667zM234.667 181.333A10.66 10.66 0 00245.334 192h128a10.66 10.66 0 0010.667-10.667 10.66 10.66 0 00-10.667-10.667h-128a10.662 10.662 0 00-10.667 10.667zM160 170.667h-21.333A10.66 10.66 0 00128 181.334a10.66 10.66 0 0010.667 10.667h10.667c0 5.896 4.771 10.667 10.667 10.667s10.667-4.771 10.667-10.667v-1.965C183.056 185.617 192 173.888 192 160c0-17.646-14.354-32-32-32-5.875 0-10.667-4.781-10.667-10.667 0-5.885 4.792-10.667 10.667-10.667h21.333c5.896 0 10.667-4.771 10.667-10.667s-4.771-10.667-10.667-10.667h-10.667c0-5.896-4.771-10.667-10.667-10.667s-10.667 4.771-10.667 10.667v1.965C136.944 91.716 128 103.445 128 117.333c0 17.646 14.354 32 32 32 5.875 0 10.667 4.781 10.667 10.667s-4.792 10.667-10.667 10.667z"/>
            </svg>
            <h1 class="checkout-heading stylish-heading">お支払い</h1>
        </div>
        <div class="checkout-section">
            <div>
                <form action="{{ route('checkout.store') }}" method="post" id="payment-form">
                    @csrf
                    <h2>お支払い情報</h2>
                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        @if(auth()->user())
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{auth()->user()->email}}" readonly>
                        @else
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{old('email')}}" required>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">住所</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}"
                               required>
                    </div>

                    <div class="half-form">
                        <div class="form-group">
                            <label for="city">市・町・村</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="prefecture">都道府県</label>
                            <input type="text" class="form-control" id="prefecture" name="prefecture"
                                   value="{{old('prefecture')}}" required>
                        </div>
                    </div> {{--end of half-form--}}

                    <div class="half-form">
                        <div class="form-group">
                            <label for="postal_code">郵便番号</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code"
                                   value="{{old('postal_code')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">電話番号</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}"
                                   required>
                        </div>
                    </div> {{--end of half-form--}}

                    <h2>お支払い方法</h2>
                    <div class="form-group">
                        <label for="name_on_card">クレジット氏名</label>
                        <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="">
                    </div>

                    <div class="form-group">
                        <label for="card-element">クレジット・デビットカード番号</label>
                        <div id="card-element">
                            <!-- Stripe Element がここに入る。 -->
                        </div>
                        <!-- Element のエラーを入れる。 -->
                        <div id="card-errors" role="alert"></div>
                    </div>
                    <span class="checkout-testmode-description">
                        ※テスト用のサイトなので料金は請求されません
                        支払いをテストするには42を続けて入力ください
                    </span>

                    <button type="submit" class="button-primary full-width" id="complete-order">支払いを完了する</button>
                </form>
            </div>

            <div class="checkout-table-container">
                <h2>注文商品詳細</h2>
                <div class="checkout-table">
                    @foreach(Cart::getContent() as $item)
                        <div class="checkout-table-row">
                            <div class="checkout-table-left">
                                <img src="{{ asset('storage/'.$item->model->image) }}" alt="product"
                                     class="checkout-table-image">
                                <div class="checkout-item-details">
                                    <div class="checkout-table-name">{{ $item->model->name }}</div>
                                    <div class="checkout-table-detail">{{ $item->model->details }}</div>
                                    <div class="checkout-table-price">{{ presentPrice($item->model->price) }}</div>
                                </div>
                            </div>
                            <div class="checkout-table-right">
                                <div class="checkout-item-quantity">
                                    {{$item->quantity}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> {{--end of checkout-table--}}

                <div class="checkout-total">
                    <div class="checkout-total-left">
                        小計 <br>
                        @if(session()->exists('coupon'))
                            <div style="display: flex">
                                @if(session()->get('coupon')['percent_off'])
                                    <span
                                        class="coupon"> クーポン適用 {{ session()->get('coupon')['percent_off'] }}% OFF</span>
                                @else
                                    <span class="coupon"> クーポン適用 {{ session()->get('coupon')['value'] }}円 OFF</span>
                                @endif
                                <form action="{{ route('coupon.destroy') }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="button-coupon">キャンセル</button>
                                </form>
                            </div>
                            <hr>
                            割引後の小計 <br>
                        @endif
                        税（10%）<br>
                        <span class="checkout-total-span">合計(税込)</span> <br>
                    </div>

                    <div class="checkout-total-right">
                        {{ presentPrice(Cart::getSubTotal()) }} <br>
                        @if(session()->exists('coupon'))
                            <span class="coupon"> —{{ presentPrice($discount) }}</span>
                            <hr>
                            {{ presentPrice($newSubTotal) }}<br>
                        @endif
                        {{ presentPrice($newTax) }} <br>
                        <span class="checkout-total-span">{{ presentPrice($newTotal) }}</span> <br>
                    </div>

                </div> {{--end of checkout-total--}}
                @if(!session()->exists('coupon'))
                    <a href="#" class="have-code">クーポンを持っていますか？</a>
                    <div class="have-code-container">
                        <form action="{{ route('coupon.confirm')}}" method="post">
                            @csrf
                            <input type="text" name="coupon">
                            <button type="submit" class="button button-apply">適用</button>
                        </form>
                    </div> {{--end of have-code-container--}}
                @endif
            </div> {{--end of checkout-table-container --}}
        </div> {{--end of checkout-section--}}
    </div>
@endsection

@section('extra-js')
    <script>
        // Create a Stripe client.
        var stripe = Stripe("{{config('services.stripe.key')}}");

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Robot,Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style,
            hidePostalCode: true,
        });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function (event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            //ボタンを２度以上押す、誤送を防ぐ
            document.getElementById('complete-order').disabled = true;

            var options = {
                name: document.getElementById('name_on_card').value,
                address_line1: document.getElementById('address').value,
                address_city: document.getElementById('city').value,
                address_state: document.getElementById('prefecture').value,
                address_zip: document.getElementById('postal_code').value,
            }
            stripe.createToken(card, options).then(function (result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;

                    //エラーが出たら再度ボタンを利用可能にする
                    document.getElementById('complete-order').disabled = false;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
@endsection
