@extends('layout')

@section('title','Cart')

@section('extra-css')

@endsection

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <a href="/">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Cart</span>
        </div>
    </div>  {{--end of breadcrumb--}}

    <div class="cart-section container">
        <div>
            @if(session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(session()->has('info_message'))
                <div class="alert alert-info">
                    {{ session()->get('info_message') }}
                </div>
            @endif

            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
             @endif

            @if(Cart::getContent()->count()>0)
                <h2>{{ Cart::getContent()->count() }}個の商品がカートに入ってます</h2>

            <div class="cart-table">
                @foreach(Cart::getContent() as $cartItem)
                {{--associate(モデル)でモデルを結びつけて、$cart->modelで呼び出す--}}
                <div class="cart-table-row">
                    <div class="cart-table-left">
                        <a href="{{ route('shop.show',$cartItem->model->slug) }}">
                            <img src="{{asset('/img/products/'.$cartItem->model->slug.'.jpg')}}" alt="" class="cart-table-img">
                        </a>
                        <div class="cart-item-details">
                            <div class="cart-item-name">
                                <a href="{{ route('shop.show',$cartItem->model->slug) }}">{{ $cartItem->model->name}}</a>
                            </div>
                            <div class="cart-item-description">{{ $cartItem->model->details}}</div>
                        </div>
                    </div> {{--end of cart-table-left--}}

                    <div class="cart-table-right">
                        <div class="cart-table-actions">
{{--                            <a href="">削除</a> <br>--}}
                            <form action="{{route('cart.destroy',$cartItem->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="cart-options">削除</button>
                            </form>
                            <a href="">ウィッシュリストに加える</a>
                        </div>

                    <div class="cart-option">
                        <select name="" id="" class="quantity">
                            <option value="" selected>1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                        </select>
                    </div>

                    <div class="cart-table-price">{{ $cartItem->model->presentPrice()}}</div>

                    </div>  {{--end of cart-table-right--}}
                </div> {{-- end of cart-table-row --}}
                @endforeach
            </div> {{--end of cart-table--}}

        <a href="#" class="have-code">コードを持っていますか？</a>
            <div class="have-code-container">
                <form action="">
                    <input type="text">
                    <button type="submit" class="button button-apply">入力</button>
                </form>
            </div> {{--end of have-code-container--}}

            <div class="cart-total">
                <div class="cart-total-left">
                    送料は無料でお手配いたします。
                </div>
                <div class="cart-total-right">
                    <div>
                        税抜き <br>
                        税(10%) <br>
                        <span class="cart-totals-total">合計(税込)</span>
                    </div>
                    <div class="cart-actual-total"> <!--(実際の金額)-->
                        {{presentPrice(Cart::getSubTotal())}}<br>
                         {{ getTax(Cart::getsubTotal()) }}<br>
                        <span class="cart-totals-total">{{ presentPrice(Cart::getTotal()) }}</span>
                    </div>
                </div>

            </div> {{--end of cart-total--}}

            <div class="cart-buttons">
                <a href="" class="button">ショッピングを続ける</a>
                <a href="" class="button-primary">お支払いに進む</a>
            </div>
             @else
                <div class="empty-cart-alert">
                    <svg fill="currentColor" width="40" height="70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 231.523 231.523"><path d="M107.415 145.798a7.502 7.502 0 008.231 6.69 7.5 7.5 0 006.689-8.231l-3.459-33.468a7.5 7.5 0 00-14.92 1.542l3.459 33.467zM154.351 152.488a7.501 7.501 0 008.231-6.69l3.458-33.468a7.499 7.499 0 00-6.689-8.231c-4.123-.421-7.806 2.57-8.232 6.689l-3.458 33.468a7.5 7.5 0 006.69 8.232zM96.278 185.088c-12.801 0-23.215 10.414-23.215 23.215 0 12.804 10.414 23.221 23.215 23.221s23.216-10.417 23.216-23.221c0-12.801-10.415-23.215-23.216-23.215zm0 31.435c-4.53 0-8.215-3.688-8.215-8.221 0-4.53 3.685-8.215 8.215-8.215 4.53 0 8.216 3.685 8.216 8.215 0 4.533-3.686 8.221-8.216 8.221zM173.719 185.088c-12.801 0-23.216 10.414-23.216 23.215 0 12.804 10.414 23.221 23.216 23.221 12.802 0 23.218-10.417 23.218-23.221 0-12.801-10.416-23.215-23.218-23.215zm0 31.435c-4.53 0-8.216-3.688-8.216-8.221 0-4.53 3.686-8.215 8.216-8.215 4.531 0 8.218 3.685 8.218 8.215 0 4.533-3.686 8.221-8.218 8.221z"/><path d="M218.58 79.08a7.5 7.5 0 00-5.933-2.913H63.152l-6.278-24.141a7.5 7.5 0 00-7.259-5.612H18.876a7.5 7.5 0 000 15h24.94l6.227 23.946c.031.134.066.267.104.398l23.157 89.046a7.5 7.5 0 007.259 5.612h108.874a7.5 7.5 0 007.259-5.612l23.21-89.25a7.502 7.502 0 00-1.326-6.474zm-34.942 86.338H86.362l-19.309-74.25h135.895l-19.31 74.25zM105.556 52.851a7.478 7.478 0 005.302 2.195 7.5 7.5 0 005.302-12.805L92.573 18.665a7.501 7.501 0 00-10.605 10.609l23.588 23.577zM159.174 55.045c1.92 0 3.841-.733 5.306-2.199l23.552-23.573a7.5 7.5 0 00-.005-10.606 7.5 7.5 0 00-10.606.005l-23.552 23.573a7.5 7.5 0 005.305 12.8zM135.006 48.311h.002a7.5 7.5 0 007.5-7.498l.008-33.311A7.5 7.5 0 00135.018 0h-.001a7.5 7.5 0 00-7.501 7.498l-.008 33.311a7.5 7.5 0 007.498 7.502z"/></svg>
                    <h3>カートは空です</h3>
                </div>
            @endif

            <h2>ウィッシュリスト</h2>
            <div class="saved-for-later cart-table">
                <div class="cart-table-row">
                    <div class="cart-table-left">
                        <a href="">
                            <img src="{{asset('/img/products/laptop-1.jpg')}}" alt="" class="cart-table-img">
                        </a>
                        <div class="cart-item-details">
                            <div class="cart-item-name"><a href="">Macbook Pro</a></div>
                            <div class="cart-item-description">15 inch, 1TB SSD, 32GB RAM</div>
                        </div>
                    </div> {{--end of cart-table-left--}}

                    <div class="cart-table-right">
                        <div class="cart-table-actions">
                            <a href="">削除</a> <br>
                            <a href="">ウィッシュリストに加える</a>
                        </div>

                        <div class="cart-option">
                            <select name="" id="" class="quantity">
                                <option value="" selected>1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                            </select>
                        </div>

                        <div class="cart-table-price">24.000円</div>

                    </div>  {{--end of cart-table-right--}}
                </div> {{-- end of cart-table-row --}}
            </div> {{--end of saved-for-later--}}

        </div>
    </div> {{--end of cart-section--}}

    @include('component.might-like')
@endsection
