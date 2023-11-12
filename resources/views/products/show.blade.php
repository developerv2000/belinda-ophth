@extends('layouts.app')

@section('title', $product->name)

@section('meta-tags')
    @php
        $shareText = App\Helpers\Helper::cleanShareText($product->description);
    @endphp

    <meta name="description" content="{{ $shareText }}">
    <meta property="og:description" content="{{ $shareText }}">
    <meta property="og:title" content="{{ $product->name }}" />
    <meta property="og:image" content="{{ asset('img/products/' . $product->image) }}">
    <meta property="og:image:alt" content="{{ $product->name }}">
    <meta name="twitter:title" content="{{ $product->name }}">
    <meta name="twitter:image" content="{{ asset('img/products/' . $product->image) }}">
@endsection

@section('main')
<main class="products-show-page" role="main">

    @php
        $navs = [
            [
                'title' => 'Продукты',
                'link' => route('products.index')
            ],

            [
                'title' => $product->name,
                'link' => '#'
            ]
        ];
    @endphp

    @include('layouts.breadcrumbs', $navs)

    <section class="product-content">
        <div class="main-container product-content__inner">
            <div class="product-content__left">
                <h2><span>{{ $product->prescription->title }}</span>{{ $product->name }}</h2>
                <div class="product-content__description">{!! $product->description !!}</div>
                <div class="product-content__actions">
                    <a href="/instructions/{{ $product->instruction }}" class="button" target="_blank">
                        <span class="material-icons-outlined">file_download</span> Скачать инструкцию
                    </a>

                    @if($product->obtain_link)
                        <a href="{{ $product->obtain_link }}" class="button" target="_blank">
                            <span class="material-icons-outlined">payment</span> Узнать цену
                        </a>
                    @endif
                </div>

                <div class="product-content__image">
                    <img src="{{ asset('img/products/' . $product->image) }}" alt="{{ $product->name }}">
                    <p>Bнешний вид товара может отличаться от изображённого</p>
                </div>
            </div>

            <div class="product-content__right">
                {!! $product->body !!}
            </div>
        </div>
    </section>

    @if(count($similarProducts))
        <section class="similar-products">
            <div class="main-container similar-products__inner">
                <h1 class="main-title">Похожие продукты</h1>
                <x-products-carousel :products="$similarProducts" />
            </div>
        </section>
    @endif

</main>

@endsection
