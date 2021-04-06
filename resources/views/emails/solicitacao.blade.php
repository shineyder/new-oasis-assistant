@component('mail::message')
{{-- Greeting --}}
@lang('Olá!')

{{-- Intro Lines --}}
@lang("Uma solicitação foi enviada ao Oasis Assistant!")

{{-- Other Lines --}}
@lang("Prezado irmão Adriano Shineyder, houve uma solicitação feita pelo usuário ")
@if (Auth::check())
{{ Auth::user()->name }}.
@else
{{ $details['data']['user'] }}.
@endif
@lang("Segue abaixo a descrição da solicitação:")<br>

{{ $details['data']['msg'] }}

{{-- Salutation --}}
@lang('Atencionamente'),<br>
{{ config('app.name') }}<br>
@endcomponent
