@extends('dashboard.layouts.app')
@section("main")

<form action="{{ route('products.relations.store') }}" method="POST" class="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="model" value="{{$model}}">

    <div class="form-group">
        <label class="required">Заголовок</label>
        <input class="form-input" name="title" type="text" value="{{ old('title') }}" required>
    </div>

    @if($model == 'Impact')
        <div class="form-group">
            <label class="required">Выделять в основном поиске как ссылки быстрого доступа?</label>
            <select class="selectize-singular" name="highlight" required>
                <option value="1">Да</option>
                <option value="0" selected>Нет</option>
            </select>

            <img class="form-image" src="{{ asset('img/dashboard/search-demo.png')}}">
        </div>
    @endif

    <div class="form__actions">
        <button class="button button--success" type="submit">
            <span class="material-icons">done_all</span> Добавить
        </button>
    </div>

</form>

@endsection