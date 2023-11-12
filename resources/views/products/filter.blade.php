<form class="main-container products-filter__form" action="#" id="products-filter-form">
    <div class="prescriptions-filter">
        <select name="prescription_id" class="filter-select">
            <option value="">Рецептурность</option>
            @foreach ($prescriptions as $prescription)
                <option value="{{ $prescription->id }}" 
                    @if($request->prescription_id == $prescription->id) selected @endif>
                    {{ $prescription->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="impacts-filter">
        <select name="impact_id" class="filter-select">
            <option value="">Воздействие</option>
            @foreach ($impacts as $impact)
                <option value="{{ $impact->id }}"
                    @if($request->impact_id == $impact->id) selected @endif>
                    {{ $impact->title }}
                </option> 
            @endforeach
        </select>
    </div>

    <div class="substances-filter">
        <select name="substance_id" class="filter-select">
            <option value="">Действующее вещество</option>
            @foreach ($substances as $substance)
                <option value="{{ $substance->id }}"
                    @if($request->substance_id == $substance->id) selected @endif>
                    {{ $substance->title }}
                </option> 
            @endforeach
        </select>
    </div>
</form>