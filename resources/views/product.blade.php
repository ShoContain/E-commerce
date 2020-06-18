@extends('layout')

@section('title',$product->name)

@section('extra-css')
    <link rel="stylesheet" href="{{asset('css/algolia.css')}}">
@endsection

@section('content')

    @component('component.breadcrumb')
        <!--パンくずリスト（ホーム > メニュー > 商品）-->
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <a href="{{ route('shop.index') }}">Shop</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>{{$product->name}}</span>
    @endcomponent

    <div class="product-section container">
        <div>
            <div class="product-section-image">
                <img src="{{ productImage($product->image) }}" alt="product" id="currentImage" class="active">
            </div>
            @if($product->images)
                <div class="product-section-multiple-images">
                    {{--(array)キャストしてもエラーが出たので、decodeしてforeachで回す--}}
                    @foreach(json_decode($product->images,true ) as $image)
                        <div class="product-section-multiple-thumbnails {{ $loop->first==true ? "selected":""}}">
                            <img src="{{ productImage($image) }}" alt="product">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="product-section-info">
            <h1 class="product-section-title">{{ $product->name }}</h1>
            <span class="{{ $stock_tag }}">{{$stock_level}}</span>
            <div class="product-section-subtitle">{{ $product->details }}</div>
            <div class="product-section-price">{{ $product->presentPrice() }}</div>
            <p>
                {!! $product->description !!}
            </p>
            <p>&nbsp;</p>

            {{--在庫0ならhidden--}}
            @if($product->quantity>0)
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$product->id}}">
                <input type="hidden" name="name" value="{{$product->name}}">
                <input type="hidden" name="price" value="{{$product->price}}">
                <button class="button" type="submit">カートに入れる</button>
            </form>
            @endif

        </div>
    </div> {{--end of product-section--}}

    @include('component.might-like')

@endsection


@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/algoliasearch@3/dist/algoliasearchLite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
{{--    publicフォルダに記述--}}
    <script src="{{ asset('js/algolia.js') }}"></script>

    <script>
        (function () {
            const currentImage = document.querySelector('#currentImage');
            const images = document.querySelectorAll('.product-section-multiple-thumbnails');

            images.forEach((element)=>element.addEventListener('click',thumbnailClick));

            function thumbnailClick(e) {
                currentImage.classList.remove('active');

                currentImage.addEventListener('transitionend',()=>{
                    currentImage.src = this.querySelector('img').src;
                    currentImage.classList.add('active');
                });

                images.forEach((element)=>element.classList.remove('selected'));
                this.classList.add('selected');
            }
        }());
    </script>
@endsection
