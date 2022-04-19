<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel-E-COMMERCE</title>

        {{--Fonts--}}
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:300,400,700" rel="stylesheet">

        {{--Style--}}
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('/css/responsive.css') }}">
    </head>
    <body>
        <header class="with-background">
            <div class="top-nav container">
                <div class="logo">E-COMMERCE</div>
                <div class="top-nav-left">
                    {{ menu('header_menu','component.menu.header_menu') }}
                </div>
                <div class="top-nav-right">
                    @include('component.menu.top-nav-right')
                </div>
            </div> {{--end of top-nav--}}

            <div class="hero container">
                <div class="hero-copy">
                    <h1>ショップサイト</h1>
                    <p>豊富な商品をご準備しております</p>
                    <div class="hero-buttons">
                        <a href="#" class="button button-white">Button 1</a>
                        <a href="#" class="button button-white">Button 2</a>
                    </div>
                </div> {{--end of hero-copy--}}

                <div class="hero-image">
                    <img src="img/ipad.png" alt="hero image">
                </div>
            </div> {{--end of hero--}}
        </header>

        <div class="featured-section">
            <div class="container">
                    <h1 class="text-center">Ecommerce</h1>
                <div class="text-center button-container">
                        <a href="#" class="button">機能</a>
                        <a href="#" class="button">セール</a>
                    </div>

                <div class="products text-center">
                    @foreach($products as $product)
                    <div class="product">
                        <a href="{{route('shop.show',$product->slug)}}">
                            <img src="{{ asset('storage/'.$product->image) }}" alt="product">
                        </a>
                        <a href="{{route('shop.show',$product->slug)}}">
                            <div class="product-name">{{ $product->name }}</div>
                        </a>
                        <div class="product-price">{{$product->presentPrice()}}</div>
                    </div>
                    @endforeach
                </div> {{--end of product--}}

                <div class="text-center button-container">
                    <a href="{{ route('shop.index') }}" class="button">商品をもっと見る</a>
                </div>

            </div> {{--end of container--}}
        </div>{{-- end of featured section--}}

        <div class="blog-section">
            <div class="container">
                <h1 class="text-center">From our Blog</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis consequuntur cumque distinctio doloremque eum expedita quod sunt velit! Atque, consequuntur!</p>
                <div class="blog-posts">
                    <div class="blog-post" id="blog1">
                        <a href="#"><img src="img/blog1.png" alt="blog image"></a>
                        <a href="#"><h2 class="blog-title">Blog Post Title</h2></a>
                        <div class="blog-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, voluptates.</div>
                    </div>
                    <div class="blog-post" id="blog2">
                        <a href="#"><img src="img/blog2.png" alt="blog image"></a>
                        <a href="#"><h2 class="blog-title">Blog Post Title</h2></a>
                        <div class="blog-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, voluptates.</div>
                    </div>
                    <div class="blog-post" id="blog3">
                        <a href="#"><img src="img/blog3.png" alt="blog image"></a>
                        <a href="#"><h2 class="blog-title">Blog Post Title</h2></a>
                        <div class="blog-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, voluptates.</div>
                    </div>
                </div> {{--end of blog-posts--}}
            </div> {{--end of container--}}
        </div> {{--end of blog-section--}}

        <footer>
            <div class="footer-content container">
                <div class="made-with">2020 Copy Right Reserved</div>
                {{ menu('footer_menu','component.menu.footer_menu') }}
            </div>
        </footer>
    </body>
</html>
