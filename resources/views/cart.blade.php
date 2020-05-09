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
            <h2>3つの商品がカートに入ってます</h2>
            <div class="cart-table">

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
                        20,000円 <br>
                        2000円 <br>
                        <span class="cart-totals-total">22,000円</span>
                    </div>
                </div>

            </div> {{--end of cart-total--}}

            <div class="cart-buttons">
                <a href="" class="button">ショッピングを続ける</a>
                <a href="" class="button-primary">お支払いに進む</a>
            </div>

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

{{--    @include('component.might-like')--}}
@endsection
