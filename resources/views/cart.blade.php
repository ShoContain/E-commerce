@extends('layout')

@section('title','Cart')

@section('extra-css')
    <link rel="stylesheet" href="{{asset('css/algolia.css')}}">
@endsection

@section('content')

    @component('component.breadcrumb')
        <!--パンくずリスト（ホーム > メニュー > 商品）-->
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Cart</span>
    @endcomponent

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
                <h2>{{ Cart::getTotalQuantity() }}個の商品がカートに入ってます</h2>

            <div class="cart-table">
                @foreach(Cart::getContent() as $cartItem)
                {{--associate(モデル)でモデルを結びつけて、$cart->modelで呼び出す--}}
                <div class="cart-table-row">
                    <div class="cart-table-left">
                        <a href="{{ route('shop.show',$cartItem->model->slug) }}">
                            <img src="{{ asset('storage/'.$cartItem->model->image) }}" alt="product" class="cart-table-img">
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
                            <form action="{{route('cart.switchToWishList',$cartItem->id)}}" method="post">
                                @csrf
                                <button type="submit" class="cart-options">欲しいものリストに加える</button>
                            </form>
                        </div>

                    <div class="cart-option">
                        <select name="quantity" class="quantity" data-id="{{$cartItem->id}}" data-productQuantity="{{ $cartItem->model->quantity }}">
                            @for($i=1;$i<=4;$i++)
                                <option {{ $cartItem->quantity===$i ? "selected":''}}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="cart-table-price">{{ presentPrice($cartItem->price*$cartItem->quantity)}}</div>

                    </div>  {{--end of cart-table-right--}}
                </div> {{-- end of cart-table-row --}}
                @endforeach
            </div> {{--end of cart-table--}}

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
                <a href="{{ route('shop.index') }}" class="button">ショッピングを続ける</a>
                <a href="{{ route('checkout.index') }}" class="button-primary">お支払いに進む</a>
            </div>
             @else
                <div class="empty-cart-alert">
                    <svg fill="currentColor" width="40" height="70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 231.523 231.523"><path d="M107.415 145.798a7.502 7.502 0 008.231 6.69 7.5 7.5 0 006.689-8.231l-3.459-33.468a7.5 7.5 0 00-14.92 1.542l3.459 33.467zM154.351 152.488a7.501 7.501 0 008.231-6.69l3.458-33.468a7.499 7.499 0 00-6.689-8.231c-4.123-.421-7.806 2.57-8.232 6.689l-3.458 33.468a7.5 7.5 0 006.69 8.232zM96.278 185.088c-12.801 0-23.215 10.414-23.215 23.215 0 12.804 10.414 23.221 23.215 23.221s23.216-10.417 23.216-23.221c0-12.801-10.415-23.215-23.216-23.215zm0 31.435c-4.53 0-8.215-3.688-8.215-8.221 0-4.53 3.685-8.215 8.215-8.215 4.53 0 8.216 3.685 8.216 8.215 0 4.533-3.686 8.221-8.216 8.221zM173.719 185.088c-12.801 0-23.216 10.414-23.216 23.215 0 12.804 10.414 23.221 23.216 23.221 12.802 0 23.218-10.417 23.218-23.221 0-12.801-10.416-23.215-23.218-23.215zm0 31.435c-4.53 0-8.216-3.688-8.216-8.221 0-4.53 3.686-8.215 8.216-8.215 4.531 0 8.218 3.685 8.218 8.215 0 4.533-3.686 8.221-8.218 8.221z"/><path d="M218.58 79.08a7.5 7.5 0 00-5.933-2.913H63.152l-6.278-24.141a7.5 7.5 0 00-7.259-5.612H18.876a7.5 7.5 0 000 15h24.94l6.227 23.946c.031.134.066.267.104.398l23.157 89.046a7.5 7.5 0 007.259 5.612h108.874a7.5 7.5 0 007.259-5.612l23.21-89.25a7.502 7.502 0 00-1.326-6.474zm-34.942 86.338H86.362l-19.309-74.25h135.895l-19.31 74.25zM105.556 52.851a7.478 7.478 0 005.302 2.195 7.5 7.5 0 005.302-12.805L92.573 18.665a7.501 7.501 0 00-10.605 10.609l23.588 23.577zM159.174 55.045c1.92 0 3.841-.733 5.306-2.199l23.552-23.573a7.5 7.5 0 00-.005-10.606 7.5 7.5 0 00-10.606.005l-23.552 23.573a7.5 7.5 0 005.305 12.8zM135.006 48.311h.002a7.5 7.5 0 007.5-7.498l.008-33.311A7.5 7.5 0 00135.018 0h-.001a7.5 7.5 0 00-7.501 7.498l-.008 33.311a7.5 7.5 0 007.498 7.502z"/></svg>
                    <h3>カートは空です</h3>
                </div>
            @endif

            @if(app('wishList')->getContent()->count()>0)
                <div class="wish-list-info">
                    <svg style="padding-top: 20px" fill="currentColor" height="70" width="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M446.752 137.856a15.831 15.831 0 00-3.456-5.184L315.328 4.704a15.831 15.831 0 00-5.184-3.456C308.224.448 306.144 0 304 0H96C78.336 0 64 14.368 64 32v448c0 17.632 14.336 32 32 32h336c8.832 0 16-7.168 16-16V144c0-2.144-.448-4.224-1.248-6.144zM320 54.624L393.376 128H320V54.624zM416 480H96V32h192v96c0 17.632 14.336 32 32 32h96v320z"/><path d="M240 96h-96c-8.832 0-16 7.168-16 16s7.168 16 16 16h96c8.832 0 16-7.168 16-16s-7.168-16-16-16zM240 160h-96c-8.832 0-16 7.168-16 16s7.168 16 16 16h96c8.832 0 16-7.168 16-16s-7.168-16-16-16zM351.136 328.032c-1.856-5.696-6.784-9.824-12.736-10.72l-46.848-7.168-21.088-44.928c-5.248-11.232-23.68-11.232-28.928 0l-21.088 44.928-46.848 7.168c-5.952.896-10.88 5.056-12.736 10.72-1.92 5.696-.512 11.968 3.712 16.256l34.336 35.232-8.128 49.92c-.992 6.048 1.568 12.128 6.56 15.648s11.552 3.936 16.96.928L256 422.944l41.696 23.04A15.98 15.98 0 00305.44 448c3.264 0 6.464-.992 9.216-2.912a15.99 15.99 0 006.56-15.648l-8.128-49.92 34.336-35.232c4.224-4.288 5.632-10.56 3.712-16.256zm-66.56 34.912a16.066 16.066 0 00-4.352 13.76l4.128 25.376-20.608-11.392a15.89 15.89 0 00-15.488 0l-20.608 11.392 4.128-25.376c.8-5.024-.768-10.112-4.352-13.76l-18.24-18.688 24.512-3.744c5.28-.8 9.824-4.192 12.064-9.024L256 309.664l10.24 21.824c2.24 4.832 6.784 8.224 12.064 9.024l24.512 3.744-18.24 18.688z"/></svg>
                    <h2>{{ app('wishList')->getContent()->count() }}個の商品が欲しいものリストに入ってます</h2>
                </div>
            <div class="saved-for-later cart-table">
                @foreach(app('wishList')->getContent() as $wishList)
                <div class="cart-table-row">
                    <div class="cart-table-left">
                        <a href="{{ route('shop.show',$wishList->model->slug) }}">
                            <img src="{{asset('/img/products/'.$wishList->model->slug.'.jpg')}}" alt="" class="cart-table-img">
                        </a>
                        <div class="cart-item-details">
                            <div class="cart-item-name"><a href="{{ route('shop.show',$wishList->model->slug) }}">{{ $wishList->model->name }}</a></div>
                            <div class="cart-item-description">{{ $wishList->model->details }}</div>
                        </div>
                    </div> {{--end of cart-table-left--}}

                    <div class="cart-table-right">
                        <div class="cart-table-actions">
                            <form action="{{route('wishlist.destroy',$wishList->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="cart-options">削除</button>
                            </form>
                            <form action="{{route('wishlist.switchToCart',$wishList->id)}}" method="post">
                                @csrf
                                <button type="submit" class="cart-options">カートに加える</button>
                            </form>
                        </div>


                        <div class="cart-table-price">{{ presentPrice($wishList->model->price) }}</div>

                    </div>  {{--end of cart-table-right--}}
                </div> {{-- end of cart-table-row --}}
                @endforeach
            </div> {{--end of saved-for-later--}}
            @else
                <div class="empty-wish-list">
                    <h2>欲しいものリストはまだ空です</h2>
                </div>
            @endif
        </div>
    </div> {{--end of cart-section--}}

    @include('component.might-like')
@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/algoliasearch@3/dist/algoliasearchLite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
{{--    publicフォルダに記述--}}
    <script src="{{ asset('js/algolia.js') }}"></script>

    <script>
        (function() {
            const classname = document.querySelectorAll('.quantity')

            Array.from(classname).forEach(function (element) {
                element.addEventListener('change',function () {
                    const id = element.getAttribute('data-id');
                    const productQuantity = element.getAttribute('data-productQuantity')
                    axios.patch(`/cart/${id}`,{
                        quantity:this.value,　           //ドロップダウンで指定した数量
                        productQuantity:productQuantity, //実際の数量
                    }).then(function (response) {
                        console.log(response);
                        //指定のURLを取得
                        {{--window.location.href=`{{route('cart.index')}}`--}}

                    }).catch(function (error) {
                        console.log(error);
                        window.location.href=`{{route('cart.index')}}`
                    })
                })
            })

        }());
    </script>
@endsection


