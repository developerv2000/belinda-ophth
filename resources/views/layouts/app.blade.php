<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title')@yield('title'){{ ' – Belinda Ophthalmology' }}@else{{'Belinda Ophthalmology – Здоровье - вечная ценность'}}@endif</title

    {{-----------Meta tags start--------- --}}
    {{-- Same metas for all routes --}}
    <meta name="keywords" content="Belinda Ophthalmology, здоровье, фармкомпания, препарат, медицина, лечение, медицинские исследования, health, medicine, medical researches"/>
    <meta property="og:site_name" content="Belinda Ophthalmology">
    <meta property="og:type" content="object" />
    <meta name="twitter:card" content="summary_large_image">

    @hasSection ('meta-tags')
        @yield('meta-tags')
    @else
        @php $shareText = 'Мы заботимся и отвечаем за здоровье каждого нашего клиента, ведь забота и ответственность, является наивысшим приоритетом и миссией компании. Поэтому мы реализуем только сертифицированные и зарегистрированные препараты и несем за это полную ответственность.'; @endphp
        <meta name="description" content="{{ $shareText }}">
        <meta property="og:description" content="{{ $shareText }}">
        <meta property="og:title" content="Belinda Ophthalmology" />
        <meta property="og:image" content="{{ asset('img/main/logo-share.png') }}">
        <meta property="og:image:alt" content="Belinda Ophthalmology logo">
        <meta name="twitter:title" content="Belinda Ophthalmology">
        <meta name="twitter:image" content="{{ asset('img/main/logo-share.png') }}">
    @endif
    {{----------- Meta tags end-----------}}

    {{-- Favicons for all devices --}}
    <link rel="icon" href="{{ asset('img/main/cropped-favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('img/main/cropped-favicon-192x192.png') }}" sizes="192x192">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('img/main/cropped-favicon-180x180.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('img/main/cropped-favicon-270x270.png') }}">

    {{-- Open Sans Google fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    {{-- Owl Carousel --}}
    <link rel="stylesheet" href="{{ asset('js/plugins/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/owl-carousel/owl.theme.default.min.css') }}">
    {{-- Selectric --}}
    <link rel="stylesheet" href="{{ asset('js/plugins/selectric/selectric.css') }}">

    {{-- <link rel="stylesheet" href="{{ mix('css/minified/app.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
</head>

<body>
    @include('layouts.header')
    @include('search.section')
    @yield('main')
    @include('layouts.footer')

    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- Owl Carousel --}}
    <script src="{{ asset('js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    {{-- Selectric plugin --}}
    <script src="{{ asset('js/plugins/selectric/selectric.min.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>

    @production
        @include('layouts.analytics')
    @endproduction
</body>

</html>
