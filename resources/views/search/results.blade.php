@if($resultsCount)
    <ul class="search-results__list">
        @foreach ($searchProducts as $product)
            <li>
                <a href="{{ route('products.show', $product->url) }}">
                    <span class="results-title">{{ $product->name }}</span>
                    <span class="results-url">Главная / Продукты</span>
                    <span class="results-visit">
                        <span class="material-icons-outlined">east</span> Перейти
                    </span>
                </a>
            </li>
        @endforeach

    @foreach ($searchResearches as $research)
        <li>
            <a href="{{ route('researches.show', $research->url) }}">
                <span class="results-title">{{ $research->title }}</span>
                <span class="results-url">Главная / Исследования</span>
                <span class="results-visit">
                    <span class="material-icons-outlined">east</span> Перейти
                </span>
            </a>
        </li>
    @endforeach
    </ul>

@else 
    <ul class="search-results__list">
        <li>По вашему запросу ничего не найдено. Пожалуйста, попробуйте новый поиск !</li>
    </ul>
@endif