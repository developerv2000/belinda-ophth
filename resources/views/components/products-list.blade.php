@if(count($products))
    <div class="products-list">
        @foreach ($products as $product)
            <x-products-card :product="$product" />
        @endforeach
    </div>
{{ $products->links('layouts.pagination') }}

@else
    <div class="warning">
        <span class="material-icons-outlined">error_outline</span>
        По вашему запросу ничего не найдено. Пожалуйста, попробуйте новый поиск.
    </div>
@endif
