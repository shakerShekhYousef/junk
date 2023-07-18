@component('mail::message')

{{$text}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
