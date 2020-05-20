
@extends('layout')

@section('title',$product->name)

@section('extra-css')

@endsection

@section('content')
    <!--パンくずリスト（ホーム > メニュー > 商品）-->
    <div class="breadcrumb">
        <div class="container">
            <a href="/">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <a href="{{ route('shop.index') }}">Shop</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>MacBook Pro</span>
        </div>
    </div>  {{--end of breadcrumb--}}

    <div class="product-section container">
        <div class="product-section-image">
            <img src={{ asset('img/products/'.$product->slug.'.jpg') }} alt="product">
        </div>
        <div class="product-section-info">
            <h1 class="product-section-title">{{ $product->name }}</h1>
            <div class="product-section-subtitle">{{ $product->details }}</div>
            <div class="product-section-price">{{ $product->presentPrice() }}</div>
            <p>
                {!! $product->description !!}
            </p>
            <p>&nbsp;</p>
{{--            <a href="" class="button">カートに入れる</a>--}}
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$product->id}}">
                <input type="hidden" name="name" value="{{$product->name}}">
                <input type="hidden" name="price" value="{{$product->price}}">
                <button class="button" type="submit">カートに入れる</button>
            </form>
        </div>
    </div> {{--end of product-section--}}

    @include('component.might-like')

@endsection
