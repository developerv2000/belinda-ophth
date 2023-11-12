@props(['researches'])

<div class="researches-list">
    @foreach ($researches as $research)
        <x-researches-card :research="$research" />
    @endforeach
</div>