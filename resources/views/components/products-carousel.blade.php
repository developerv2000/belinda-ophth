@props(['products'])

<div class="products-carousel-container">
    <div class="owl-carousel products-carousel" id="products-carousel">
        @foreach ($products as $product)
            <x-products-card class="products-carousel__item" :product="$product" />
        @endforeach
    </div>

    <span class="material-icons-outlined unselectable owl-nav owl-nav--prev" id="products-carousel-prev-nav">arrow_back_ios</span>
    <span class="material-icons-outlined unselectable owl-nav owl-nav--next" id="products-carousel-next-nav">arrow_forward_ios</span>
</div>