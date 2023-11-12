@props(['research'])

<div class="research-list__item" style="background-image: url({{ asset('img/researches/' . $research->image) }})">
    <h2>{{$research->product->name}}</h2>
    <p>{{$research->subtitle}}</p>
    <a href="{{route('researches.show', $research->url)}}">Читать</a>
</div>