<section class="breadcrumbs">
    <div class="main-container breadcrumbs__inner">
        <ul>
            <li>
                <a href="{{ route('home') }}">Главная</a>
            </li>

            <li>
                <span class="material-icons-outlined">arrow_right</span>
            </li>
    
            @foreach ($navs as $nav)                
                @if($loop->last)
                    <li>
                        <a>{{ $nav['title'] }}</a>
                    </li>
                @else
                    <li>
                        <a href="{{ $nav['link'] }}">{{ $nav['title'] }}</a>
                    </li>

                    <li>
                        <span class="material-icons-outlined">arrow_right</span>
                    </li>
                @endif
            @endforeach
    
        </ul>
    </div>
</section>