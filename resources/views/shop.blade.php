@extends('layout')

@section('title','Products')

@section('extra-css')
@endsection

@section('content')

    <!--パンくずリスト（ホーム > メニュー > 商品）-->
    <div class="breadcrumb">
        <div class="container">
            <a href="/">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Shop</span>
        </div>
    </div>  {{--end of breadcrumb--}}

    <div class="products-section container">
        <div class="sidebar">
            <h3>カテゴリー</h3>
            <ul>
                <li><a href="">ノートパソコン</a></li>
                <li><a href="">デスクトップパソコン</a></li>
                <li><a href="">スマートフォン</a></li>
                <li><a href="">タブレット</a></li>
                <li><a href="">テレビ</a></li>
                <li><a href="">デジタルカメラ</a></li>
                <li><a href="">電化製品</a></li>
            </ul>

            <h3>値段</h3>
            <ul>
                <li><a href="">0-7000円</a></li>
                <li><a href="">7000-2万5千円</a></li>
                <li><a href="">2万5千円以上</a></li>
            </ul>
        </div> {{--end of sidebar--}}

        <div>
            <h1 class="stylish-border">ラップトップ</h1>
            <div class="products text-center"> <!--grid-container-->
                @foreach($products as $product)
                <div class="product">
                    <a href="{{ route('shop.show',$product->slug) }}"><img src={{asset('img/products/'.$product->slug.'.jpg')}} alt=""></a>
                    <a href="{{ route('shop.show',$product->slug) }}"><div>{{ $product->name }}</div></a>
                    <div class="product-price">{{ $product->presentPrice() }}</div>
                </div>
                @endforeach
            </div> {{--end of products--}}
        </div>
    </div>

@endsection

