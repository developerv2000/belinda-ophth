<header class="header" id="header">
    <h1 class="header__title">
        {{-- first level --}}
        @if(strpos($route, 'products') !== false  || $route == 'dashboard.index') Продукты 
        @elseif(strpos($route, 'researches') !== false) Исследования
        @elseif(strpos($route, 'slides') !== false) Слайдер
        @elseif(strpos($route, 'mailing') !== false) Email рассылка
        @endif

        {{-- second level for CREATE --}}
        @if($route == 'products.relations.create') / {{ $relationTitle }} / Добавить
        @elseif(strpos($route, 'create') ) / Добавить
        {{-- second level for EDIT --}}
        @elseif($route == 'products.edit') / {{ $product->name }}
        @elseif($route == 'products.relations.edit') / {{ $relationTitle }} / {{ $item->title }}
        @elseif($route == 'researches.edit') / {{ $research->title }}
        @elseif($route == 'slides.edit') / {{ $slide->title }}
        @elseif($route == 'products.relations.index') / {{ $relationTitle }}
        @endif

        {{-- Third level for Relations --}}


        {{-- items count --}}
        @if( strpos($route, 'index') ) ({{ count($items) }}) @endif
    </h1>

    <div class="header__actions">
        {{-- Create Buttons --}}
        @switch($route)
            @case('dashboard.index')
                <a href="{{route('products.create')}}">
                    <span class="material-icons">add</span> Добавить
                </a>
            @break

            @case('dashboard.researches.index')
                <a href="{{route('researches.create')}}">
                    <span class="material-icons">add</span> Добавить
                </a>
            @break

            @case('dashboard.slides.index')
                <a href="{{route('slides.create')}}">
                    <span class="material-icons">add</span> Добавить
                </a>
            @break

            @case('products.relations.index')
                <a href="{{route('products.relations.create')}}?model={{ $model }}">
                    <span class="material-icons">add</span> Добавить
                </a>
            @break
        @endswitch

        {{-- Multiple Delete buttons for all index routes --}}
        @switch($route)
            @case('dashboard.index')
            @case('dashboard.researches.index')
            @case('dashboard.slides.index')
            @case('dashboard.mailing.index')
            @case('products.relations.index')
                <button onclick="toggleCheckboxes()">
                    <span class="material-icons">done_all</span> Отметить все
                </button>

                <button data-bs-toggle="modal" data-bs-target="#destroy-multiple-form">
                    <span class="material-icons">clear</span> Удалить отмеченные
                </button>
            @break
        @endswitch
    </div>
</header>