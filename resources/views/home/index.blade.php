@extends('layouts.app')

@section('main')
    <main class="home-page" role="main">
        {{-- Welcome start --}}
        <section class="welcome">
            {{-- Welcome carousel start --}}
            <div class="main-container welcome-carousel-container">
                <div class="welcome-carousel-container__inner">
                    <div class="owl-carousel welcome-carousel" id="welcome-carousel">
                        @foreach ($slides as $slide)
                            <div class="welcome-carousel__item">
                                <img src="{{ asset('img/slides/' . $slide->image) }}" alt="{{ $slide->title }}">
                                <div>
                                    <h2>{{ $slide->title }}</h2>
                                    <p>{{ $slide->body }}</p>
                                    <a class="button" href="{{ $slide->link }}">{{ $slide->button }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <span class="material-icons-outlined unselectable owl-nav owl-nav--prev" id="welcome-carousel-prev-nav">arrow_back_ios</span>
                    <span class="material-icons-outlined unselectable owl-nav owl-nav--next" id="welcome-carousel-next-nav">arrow_forward_ios</span>
                </div>
            </div> {{-- Welcome carousel end --}}

            {{-- Advantages start --}}
            <div class="main-container advantages-main-container">
                <div class="advantages owl-carousel owl-theme">
                    <div class="advantages__item">
                        <div>
                            <span>1</span>
                            <h3>Качество</h3>
                        </div>
                        <p>Гарантируем подлинность, правильность хранения, контроль сроков годности продукции.</p>
                    </div>

                    <div class="advantages__item">
                        <div>
                            <span>2</span>
                            <h3>Эффективность</h3>
                        </div>
                        <p>Обязательное условие нашей деятельности, которое находится на ценностном уровне компании.</p>
                    </div>

                    <div class="advantages__item">
                        <div>
                            <span>3</span>
                            <h3>Доверие</h3>
                        </div>
                        <p>Реализуем только сертифицированные и зарегистрированные препараты и несем за них полную ответственность.</p>
                    </div>

                    <div class="advantages__item">
                        <div>
                            <span>4</span>
                            <h3>Безопасность</h3>
                        </div>
                        <p>Стремимся обеспечить вам безопасные, качественные и новаторские продукцию.</p>
                    </div>
                </div>
            </div> {{-- Advantages end --}}
        </section> {{-- Welcome end --}}

        <section class="researches home-researches">
            <div class="main-container researches__inner">
                <h1 class="main-title">Наши исследования</h1>
                <x-researches-list :researches="$researches" />
            </div>
        </section>

        <section class="popular-products">
            <div class="main-container popular-products__inner">
                <h1 class="main-title">Популярные продукты</h1>
                <x-products-carousel :products="$products" />
                <a href="{{ route('products.index') }}" class="button popular-products__all">Все продукты</a>
            </div>
        </section>
    </main>
@endsection
