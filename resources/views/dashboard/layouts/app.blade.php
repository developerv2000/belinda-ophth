<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Админка – Belinda Ophthalmology</title>

    {{-- Noindex remove on production --}}
    <meta name="robots" content="none" />
    <meta name="googlebot" content="noindex, nofollow" />
    <meta name="yandex" content="none">

    {{-- Roboto Google fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
    {{-- Bootstrap 5.1.3 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{-- Selectize --}}
    <link href="{{ asset('js/plugins/selectize/dist/css/selectize.css') }}" rel="stylesheet">
    {{-- Simditor v2.3.28 --}}
    <link href="{{ asset('js/plugins/simditor/styles/simditor.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    <div class="content" id="content">
        @include('dashboard.layouts.header')
        @include('dashboard.layouts.aside')

        <main class="main" id="main">
            @include('dashboard.layouts.errors')
            @yield('main')
        </main>
    </div>

    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- Boostrap 5.1.3 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    {{-- Selectize --}}
    <script src="{{ asset('js/plugins/selectize/dist/js/standalone/selectize.min.js') }}"></script>
    {{-- Simditor v2.3.28 --}}
    <script src="{{ asset('js/plugins/simditor/scripts/module.js') }}"></script>
    <script src="{{ asset('js/plugins/simditor/scripts/hotkeys.js') }}"></script>
    <script src="{{ asset('js/plugins/simditor/scripts/uploader.js') }}"></script>
    <script src="{{ asset('js/plugins/simditor/scripts/simditor.js') }}"></script>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>