<x-app-layout>
    <x-slot name="header">
        {{ __('Território Local') }}
    </x-slot>

    <img class="map" id="Mapa_Local" src="{{asset('maps/'. $local . '.jpg')}}" alt="Mapa Local">

    <a href="{{route('territory.regio', $regio)}}">
        <x-jet-danger-button class="ml-4">
            {{ __('Voltar') }}
        </x-jet-danger-button>
    </a>

    <iframe scrolling="no" src="{{route('territory.show', $local)}}" id="frame-rel"></iframe>
</x-app-layout>
