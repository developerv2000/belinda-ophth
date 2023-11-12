@extends('dashboard.layouts.app')
@section("main")

@if(!$errors->any() && $activePage == 1)
    <div class="alert alert-warning warning-container">
        <span class="material-icons">warning</span>
        При удалении продукта, также удалятся исследования по этому продукту
    </div>
@endif

@include('dashboard.layouts.search')

{{-- Main form start --}}
<form action="{{ route('products.destroy') }}" method="POST" class="table-form" id="table-form">
    @csrf
    {{-- Table start --}}
    <table class="main-table" cellpadding = "8" cellspacing = "10">
        {{-- Table Head start --}}
        <thead>
            <tr>
                {{-- empty space for checkbox --}}
                <th width="20"></th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'name' ? 'active' : ''}}" href="{{route('dashboard.index')}}?page={{$activePage}}&orderBy=name&orderType={{$reversedOrderType}}">Название</a>
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'prescriptionTitle' ? 'active' : ''}}" href="{{route('dashboard.index')}}?page={{$activePage}}&orderBy=prescriptionTitle&orderType={{$reversedOrderType}}">Рецептурность</a>
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'formTitle' ? 'active' : ''}}" href="{{route('dashboard.index')}}?page={{$activePage}}&orderBy=formTitle&orderType={{$reversedOrderType}}">Форма</a>
                </th>

                <th width="120">
                    Действие
                </th>
            </tr>
        </thead>  {{-- Table Head end --}}

        {{-- Table Body start --}}
        <tbody>
            @foreach ($products as $product)
                <tr>
                    {{-- Checkbox for multidelete --}}
                    <td width="20">
                        <div class="checkbox">
                            <label for="item{{$product->id}}">
                                <input id="item{{$product->id}}" type="checkbox" name="id[]" value="{{$product->id}}">
                                <span></span>
                            </label>
                        </div>
                    </td>

                    <td>{{ $product->name }}</td>
                    <td>{{ $product->prescriptionTitle }}</td>
                    <td>{{ $product->formTitle }}</td>

                    {{-- Actions --}}
                    <td width="120">
                        <div class="table__actions">
                            <a class="button--main" href="{{ route('products.show', $product->url) }}"
                                target="_blank" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Посмотреть">
                                <span class="material-icons">visibility</span>
                            </a>
        
                            <a class="button--secondary" href="{{ route('products.edit', $product->id) }}" 
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Редактировать">
                                <span class="material-icons">edit</span>
                            </a>
        
                            <button class="button--danger" type="button" onclick="showSingleDestroyModal({{ $product->id }})"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить">
                                <span class="material-icons">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>  {{-- Table Body end --}}
    </table>  {{-- Table end --}}

    {{ $products->links('dashboard.layouts.pagination') }}
</form>  {{-- Main form end --}}


@include('dashboard.modals.single-destroy', ['destroyRoute' => 'products.destroy', 'itemId' => '0'])
@include('dashboard.modals.multiple-destroy')

@endsection