@props(['product'])

<div class="product-card">
    <h2><span>{{ $product->prescription->title }}</span>{{ $product->name }}</h2>
    <img src="{{ asset('img/products/' . $product->image) }}" alt="{{ $product->name }}">

    <div class="product-card__text">
        <p class="product-card__description">{{ App\Helpers\Helper::cleanText($product->description) }}</p>
        <div>
            <p class="product-card__form">{{ $product->form->title }}</p>
            <p class="product-card__category">
                <span class="material-icons-outlined product-card__favorite-border">favorite_border</span>
                <span class="material-icons-outlined product-card__favorite">favorite</span>
                <span class="product-card__category-name">{{ $product->impact?->title }}</span>
            </p>
        </div>

        <a class="product-card__link" href="{{ route('products.show', $product->url) }}">
            <span class="producut-card__link-text">Подробнее<span> о продукте</span></span>
            <span class="material-icons-outlined">chevron_right</span>
        </a>
    </div>
</div>
