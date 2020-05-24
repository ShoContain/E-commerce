<header>
    <div class="top-nav container">
        <div class="logo">
            <a href="/">E-COMMERCE</a>
        </div>
        <div class="top-nav-left">
                {{ menu('header_menu','component.menu.header_menu') }}
        </div>
        <div class="top-nav-right">
            @include('component.menu.top-nav-right')
        </div>
    </div> {{--end of top-nav--}}
</header>
