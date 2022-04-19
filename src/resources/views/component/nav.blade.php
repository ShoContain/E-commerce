<header>
    <div class="top-nav container">
        <div class="logo">
            <a href="/">E-COMMERCE</a>
        </div>
        <div class="top-nav-left">
            @if(!(request()->is('checkout') || request()->is('guestCheckout')))
                {{ menu('header_menu','component.menu.header_menu') }}
            @endif
        </div>
        <div class="top-nav-right">
            @if(!(request()->is('checkout') || request()->is('guestCheckout')))
                @include('component.menu.top-nav-right')
            @endif
        </div>
    </div> {{--end of top-nav--}}
</header>
