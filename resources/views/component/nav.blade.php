<header>
    <div class="top-nav container">
        <div class="logo">
            <a href="/">Laravel-E-COMMERCE</a>
        </div>
        <ul>
            <li><a href="{{ route("shop.index") }}">Shop</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Blog</a></li>
            <li>
                <a href="{{ route('cart.index') }}">Cart
                @if(Cart::getContent('default')->count()>0)
                    <span class="cart-count"><span>{{ Cart::getContent('default')->count() }}</span></span>
                 @endif
                </a>
            </li>
        </ul>
    </div> {{--end of top-nav--}}
</header>
