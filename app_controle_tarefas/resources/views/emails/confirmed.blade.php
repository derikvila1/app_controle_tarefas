@component('mail::message')
# 

Olá, Sua visita foi confirmada!

Informações da visita:
Id: {{ $visita->id }}<br>
Local de Visita: {{ $visita->spaceName }}<br>
Dia: {{ $visita->day }}<br>
Hora: {{ $visita->hour }}<br>
Número de pessoas: {{ $visita->peopleNumber }}




Att,<br>
{{ config('app.name') }}
@endcomponent
