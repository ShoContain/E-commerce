<ul>
    <li>
        <a href="{{ route('cart.index') }}">
            カート
            <span class="cart-count">
                @if(Cart::getContent('default')->count()>0)
                    <span>{{ Cart::getContent('default')->count() }}</span>
                @endif
            </span>
        </a>
    </li>
    @guest
        <li><a href="{{ route('register') }}">新規登録</a></li>
        <li><a href="{{ route('login') }}">ログイン</a></li>
    @else
    <li>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">
            ログアウト
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
    @endguest
</ul>
