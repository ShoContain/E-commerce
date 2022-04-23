<div class="might-like-section">
    <div class="container">
        <h2>これも気にいるかも...</h2>
        <div class="might-like-grid">
            @foreach($mightLikes as $mightLike)
            <a href="{{ route('shop.show',$mightLike->slug) }}" class="might-like-product">
                <img src="{{ asset('storage/'.$mightLike->image) }}" alt="product">
                <div class="might-like-product-name">{{ $mightLike->name }}</div>
                <div class="might-like-product-price">{{$mightLike->presentPrice()}}</div>
            </a>
            @endforeach
        </div> {{--end of might-like-grid--}}
    </div>
</div>
