@extends('layouts.app')

@section('title', $research->title)

@section('meta-tags')
    @php
        $shareText = App\Helpers\Helper::cleanShareText($research->body, 170);
    @endphp
    
    <meta name="description" content="{{ $shareText }}">
    <meta property="og:description" content="{{ $shareText }}">
    <meta property="og:title" content="{{ $research->title }}" />
    <meta property="og:image" content="{{ asset('img/researches/' . $research->image) }}">
    <meta property="og:image:alt" content="{{ $research->title }}">
    <meta name="twitter:title" content="{{ $research->title }}">
    <meta name="twitter:image" content="{{ asset('img/researches/' . $research->image) }}">
@endsection

@section('main')

<main class="researches-show-page" role="main">

    @php
        $navs = [
            [
                'title' => 'Исследования',
                'link' => route('researches.index')
            ],

            [
                'title' => $research->title,
                'link' => '#'
            ]
        ];
    @endphp

    @include('layouts.breadcrumbs', $navs)

    <section class="research-content">
        <div class="main-container research-content__inner">
            <div class="researches__sidebar">
                <x-products-card :product="$research->product" />
                <x-researches-card :research="$anotherResearch" />
            </div>

            <div class="research-content__body">
                <h1 class="research-content__title">{{ $research->title }}</h1>
                <h2 class="research-content__subtitle">{{ $research->subtitle }}</h2>
                <div>{!! $research->body !!}</div>
            </div>
        </div>
    </section>

</main>

@endsection