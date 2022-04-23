<ul>
    @foreach($items as $menu_item)
        @if($menu_item->title=='Follow Me')
            <li>{{ $menu_item->title }}</li>

        @elseif($menu_item->title=='fa-globe')
            <li>
                <a href="{{ $menu_item->link() }}">
                    <i class="fa {{$menu_item->title}}"></i>
                </a>
            </li>
        @else
            <li>
                <a href="{{ $menu_item->link() }}">
                    <i class="fab {{$menu_item->title}}"></i>
                </a>
            </li>
        @endif
    @endforeach
</ul>
