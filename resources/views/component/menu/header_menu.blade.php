<ul>
    @foreach($items as $menu_item)
        <li>
            <a href="{{ $menu_item->link() }}">
                {{ $menu_item->title }}
                @if(Cart::getContent('default')->count()>0 && $menu_item->title==='Cart')
                    <span class="cart-count"><span>{{ Cart::getContent('default')->count() }}</span></span>
                @endif
            </a>
        </li>
    @endforeach
</ul>

{{--<ul>--}}
{{--    <li><a href="{{ route('shop.index') }}">Shop</a></li>--}}
{{--    <li><a href="#">About</a></li>--}}
{{--    <li><a href="#">Blog</a></li>--}}
{{--    <li>--}}
{{--        <a href="{{ route('cart.index') }}">Cart--}}
{{--            @if(Cart::getContent('default')->count()>0)--}}
{{--                <span class="cart-count"><span>{{ Cart::getContent('default')->count() }}</span></span>--}}
{{--            @endif--}}
{{--        </a>--}}
{{--    </li>--}}
{{--</ul>--}}
