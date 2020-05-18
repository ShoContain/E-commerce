@extends('layout')

@section('title','Shop')

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
                    @foreach($categories as $category)
                        <li class="{{ setActiveCategory($category->slug) }}">
                            <a href="{{ route('shop.index',['category'=>$category->slug]) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
{{--            <h3>値段</h3>--}}
{{--            <ul>--}}
{{--                <li><a href="">0-7000円</a></li>--}}
{{--                <li><a href="">7000-2万5千円</a></li>--}}
{{--                <li><a href="">2万5千円以上</a></li>--}}
{{--            </ul>--}}
        </div> {{--end of sidebar--}}

        <div>
            <div class="products-header">
                <h1 class="stylish-border">{{ $categoryName }}</h1>
                <div>
                    <strong>値段</strong>
                    <a href="{{ route('shop.index',['category'=>request()->category,'sort'=>'low_high']) }}">安い順</a>
                    <a href="{{ route('shop.index',['category'=>request()->category,'sort'=>'high_low']) }}">高い順</a>
                </div>
            </div>
            <div class="products text-center"> <!--grid-container-->
                @forelse($products as $product)
                    <div class="product">
                        <a href="{{ route('shop.show',$product->slug) }}"><img src={{asset('img/products/'.$product->slug.'.jpg')}} alt=""></a>
                        <a href="{{ route('shop.show',$product->slug) }}"><div>{{ $product->name }}</div></a>
                        <div class="product-price">{{ $product->presentPrice() }}</div>
                    </div>
                @empty
                    <div style="text-align: left">商品が見つかりませんでした</div>
                @endforelse
            </div> {{--end of products--}}

            <div class="pagination-content">
{{--                {{ $products->links() }}--}}
{{--                    上のpaginationだとリンクを押した際にクエリがリセットされるので
                        検索条件を保持させるためにappendsメソッドを使う--}}
                    {{ $products->appends(request()->input())->links() }}
            </div>

        </div>
    </div>

@endsection

