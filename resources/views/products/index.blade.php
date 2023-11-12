@extends('layouts.app')

@section('title', 'Продукты')

@section('main')

<main class="products-index-page" role="main">

    @php
        $navs = [
            [
                'title' => 'Продукты',
                'link' => '#'
            ]
        ];
    @endphp

    @include('layouts.breadcrumbs', $navs)

    <section class="products-warning" id="products-warning">
        <div class="main-container products-warning__inner">
            <h1>Внимание</h1>
            <p>
                Информация, представленная на сайте, не должна использоваться для самостоятельной диагностики и лечения и не может служить заменой очной консультации врача.
            </p>
        </div>
    </section>

    <section class="products-filter">
        @include('products.filter')
    </section>

    <section class="products">
        <div class="main-container products__inner">
            <h1 class="main-title">Все продукты</h1>
            <div class="products-list-container" id="products-list-container">
                <x-products-list :products="$products" />
            </div>
        </div>
    </section>

</main>

@endsection