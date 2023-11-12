<section class="search">
    <div class="main-container search__inner">
        <form class="search__form" action="#">
            <input class="search__input" type="text" placeholder="Введите поисковой запрос" oninput="submitSearch(event)" id="search-input">

            <div class="search__input-overlay"></div>

            @if(count($highlightedImpacts))
                <span class="search__links">
                    @foreach ($highlightedImpacts as $impact)
                        <a href="{{ route('products.index') . '?impact_id=' . $impact->id }}">{{ $impact->title }}</a>
                    @endforeach
                </span>
            @endif

            <button class="button search__form-button" type="button">
                <span class="material-icons-outlined search__submit" onclick="showSearchResults()">search</span>
                <span class="material-icons-outlined search__dismiss">close</span>
            </button>

            <div class="search__results" id="search-results">
                @include('search.results')
            </div>

        </form> {{-- Search Overlay end --}}
    
        <a class="button search__all-products" href="{{ route('products.index') }}">Все продукты</a>
    </div>
</section>