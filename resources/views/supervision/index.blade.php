@extends('layouts.app')

@section('title', ' Фармаконадзор')

@section('main')

<main class="supervision-index-page" role="main">

    @php
        $navs = [
            [
                'title' => 'Фармаконадзор',
                'link' => '#'
            ]
        ];
    @endphp

    @include('layouts.breadcrumbs', $navs)

    <section class="supervision-section">
        <div class="supervision-section__inner main-container">
            {!! $supervisionForm !!}
        </div>
    </section>

</main>

@endsection
