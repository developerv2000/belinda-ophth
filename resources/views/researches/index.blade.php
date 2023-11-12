@extends('layouts.app')

@section('title', 'Исследования')

@section('main')

<main class="researches-index-page" role="main">

    @php
        $navs = [
            [
                'title' => 'Исследования',
                'link' => '#'
            ]
        ];
    @endphp

    @include('layouts.breadcrumbs', $navs)

    <section class="researches">
        <div class="main-container researches__inner">
            <h1 class="main-title">Наши исследования</h1>
            <x-researches-list :researches="$researches" />
        </div>
    </section>

    <section class="researches__banner">
        <div class="main-container researches__banner-inner">
            <div class="researches__banner-background" style="background-image: url({{ asset('img/main/researches-banner.jpg') }})">
                <h1>Все для вашего здоровья</h1>
                <p>У нас найдутся все препараты для лечения глаз, горла и носа</p>
                <a href="{{ route('products.index') }}" class="button">Перейти к продуктам</a>
            </div>
        </div>
    </section>

</main>

@endsection