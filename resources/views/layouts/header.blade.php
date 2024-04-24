<header class="header">
    <div class="main-container header__inner">
        {{-- Logo start --}}
        <a class="header__logo" href="{{ route('home') }}">
            <img src="{{ asset('img/main/logo.svg') }}" alt="Belinda Ophthalmology logo">
        </a> {{-- Logo end --}}

        <nav class="header__nav">
            <ul>
                <li>
                    <a @if (strpos($route, 'home') !== false) class="active" @endif href="{{ route('home') }}">Главная</a>
                </li>

                <li>
                    <a @if (strpos($route, 'researches') !== false) class="active" @endif href="{{ route('researches.index') }}">Исследования</a>
                </li>

                <li>
                    <a @if (strpos($route, 'products') !== false) class="active" @endif href="{{ route('products.index') }}">Продукты</a>
                </li>

                <li>
                    <a @if (strpos($route, 'supervision') !== false) class="active" @endif href="{{ route('supervision.index') }}">Фармаконадзор</a>
                </li>
            </ul>
        </nav>

        <div class="header__contacts">
            <a class="header__contacts-shop" href="https://salomat.tj" target="_blank">
                <div>
                    <h3>Покупайте нашу</h3>
                    <p>продукцию с выгодой</p>
                </div>
                <span class="material-icons-outlined">shopping_cart</span>
            </a>

            <a class="header__contacts-phone" href="tel:+992918000000">
                <div>
                    <h3>Свяжитесь с нами</h3>
                    {{-- <p>Свяжитесь с нами</p> --}}
                </div>
                <span class="material-icons-outlined">map</span>
            </a>
        </div>

        <span class="material-icons-outlined mobile-menu-show">menu</span>

        {{-- Mobile menu start --}}
        <div class="mobile-menu">
            <div class="mobile-menu__header">
                <a class="mobile-menu__logo" href="{{ route('home') }}">
                    <img src="{{ asset('img/main/logo.svg') }}" alt="Belinda Ophthalmology logo">
                </a>
                <span class="material-icons-outlined mobile-menu-hide">close</span>
            </div>

            <nav class="mobile-nav">
                <ul>
                    <li>
                        <a @if (strpos($route, 'home') !== false) class="active" @endif href="{{ route('home') }}">Главная</a>
                    </li>

                    <li>
                        <a @if (strpos($route, 'researches') !== false) class="active" @endif href="{{ route('researches.index') }}">Исследования</a>
                    </li>

                    <li>
                        <a @if (strpos($route, 'products') !== false) class="active" @endif href="{{ route('products.index') }}">Продукты</a>
                    </li>

                    <li>
                        <a @if (strpos($route, 'supervision') !== false) class="active" @endif href="{{ route('supervision.index') }}">Фармаконадзор</a>
                    </li>
                </ul>
            </nav>

            <a class="mobile-menu__phone" href="tel:+992918000000">
                <div>
                    <h3>Свяжитесь с нами</h3>
                    {{-- <p>Свяжитесь с нами</p> --}}
                </div>
                <span class="material-icons-outlined">map</span>
            </a>
        </div>  {{-- Mobile menu end --}}
    </div> {{-- Header Inner end --}}
</header>
