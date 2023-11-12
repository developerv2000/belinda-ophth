<aside class="aside" id="aside">
    <span class="material-icons aside-toggler" onclick="toggleAside()" id="aside-toggler">chevron_left</span>

    <img class="aside__avatar" src="{{ asset('img/dashboard/admin.jpg') }}">

    <nav class="aside__nav">
        <ul class="aside__menu">
            <li>
                <a href="{{route('home')}}" target="_blank">
                    <span class="material-icons">home</span> Перейти на сайт
                </a>
            </li>

            <li>
                <a class="@if( strpos($route, 'products') !== false || $route == 'dashboard.index') active @endif" href="{{route('dashboard.index')}}">
                    <span class="material-icons">medication</span> Продукты
                </a>
            </li>

            @if( strpos($route, 'products') !== false || $route == 'dashboard.index') 
                <ul class="aside__submenu">
                    <li>
                        <a href="{{ route('products.relations.index') }}?model=Substance" @if(isset($model) && $model == 'Substance') class="active" @endif>Действующее вещество</a>
                    </li>

                    <li>
                        <a href="{{ route('products.relations.index') }}?model=Impact" @if(isset($model) && $model == 'Impact') class="active" @endif>Воздействие</a>
                    </li>

                    <li>
                        <a href="{{ route('products.relations.index') }}?model=Form" @if(isset($model) && $model == 'Form') class="active" @endif>Форма</a>
                    </li>
                </ul>
            @endif

            <li>
                <a class="@if( strpos($route, 'researches') !== false ) active @endif" href="{{route('dashboard.researches.index')}}">
                    <span class="material-icons">article</span> Исследования
                </a>
            </li>

            <li>
                <a class="@if( strpos($route, 'slides') !== false ) active @endif" href="{{route('dashboard.slides.index')}}">
                    <span class="material-icons">collections</span> Слайдер
                </a>
            </li>

            <li>
                <a class="@if( strpos($route, 'mailing') !== false ) active @endif" href="{{route('dashboard.mailing.index')}}">
                    <span class="material-icons">email</span> Email рассылка
                </a>
            </li>

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"><span class="material-icons">logout</span> Выйти</button>
                </form>
            </li>
        </ul>
    </nav>
</aside>