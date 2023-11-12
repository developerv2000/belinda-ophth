@extends('dashboard.layouts.app')
@section("main")

<form action="{{ route('products.relations.update') }}" method="POST" class="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="model" value="{{$model}}">
    <input type="hidden" name="id" value="{{ $item->id }}">

    <div class="form-group">
        <label class="required">Заголовок</label>
        <input class="form-input" name="title" type="text" value="{{ $item->title }}" required>
    </div>

    @if($model == 'Impact')
        <div class="form-group">
            <label class="required">Выделять в основном поиске как ссылки быстрого доступа?</label>
            <select class="selectize-singular" name="highlight" required>
                <option value="1" @if($item->highlight) selected @endif>Да</option>
                <option value="0" @if(!$item->highlight) selected @endif>Нет</option>
            </select>

            <img class="form-image" src="{{ asset('img/dashboard/search-demo.png')}}">
        </div>
    @endif

    <div class="form__actions">
        <button class="button button--success" type="submit">
            <span class="material-icons">done_all</span> Обновить
        </button>

        <button class="button button--danger" type="button" data-bs-toggle="modal" data-bs-target="#destroy-single-modal">
            <span class="material-icons">remove_circle</span> Удалить
        </button>
    </div>

</form>

@include('dashboard.modals.single-destroy', ['destroyRoute' => 'products.relations.destroy', 'itemId' => $item->id, 'model' => $model])

@endsection