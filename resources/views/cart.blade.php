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

        </div>
    </div>

@endsection
