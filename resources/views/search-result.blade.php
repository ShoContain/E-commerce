@extends('layout')

@section('title','検索結果')

@section('extra-css')
    <link rel="stylesheet" href="{{asset('css/algolia.css')}}">
@endsection

@section('content')

    @component('component.breadcrumb')
        <!--パンくずリスト（ホーム > メニュー > 商品）-->
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span class="search-span">検索結果</span>
    @endcomponent

    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="search-container container">
        <h2>検索結果</h2>
        <p>"{{ request()->input('query') }}"  <span>{{ $products->total() }}件の結果</span></p>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">商品名</th>
                <th scope="col">商品詳細</th>
                <th scope="col">商品説明</th>
                <th scope="col">値段</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th scope="row"><a href="{{route('shop.show',$product->slug)}}">{{ $product->name }}</a></th>
                    <td>{{ $product->details }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ presentPrice($product->price) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="pagination-content">
            {{ $products->appends(request()->input())->links() }}
        </div>

    </div> {{--end of search-container--}}


@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/algoliasearch@3/dist/algoliasearchLite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
{{--    publicフォルダに記述--}}
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection
