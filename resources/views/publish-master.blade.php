<x-app-layout>
    <x-slot name="header">
        {{ __('Território Completo') }}
    </x-slot>

    {!! $dataTable->table() !!}

    {!! $dataTable->scripts() !!}
</x-app-layout>

