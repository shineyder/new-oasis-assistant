@component('mail::message')
{{-- Greeting --}}
# @lang('Olá!')

{{-- Intro Lines --}}
@lang("Obrigado por usar o Oasis Assistant!")

{{-- Other Lines --}}
@lang("Prezado irmão ")
{{ Auth::user()->name }},
@lang(" houve um envio de solicitação no Fale Conosco em sua conta.")<br>

@lang("Seu ticket de atendimento é ")
<b>{{ $details['data'] }}</b><br>

@lang("Se você não é a pessoa a quem foi destinado esse e-mail, favor desconsidere-o.")

@lang("Qualquer dúvida estamos à disposição.")

{{-- Salutation --}}
@lang('Seus irmãos'),<br>
{{ config('app.name') }}<br>
@lang("Setor de Suporte")
@endcomponent
