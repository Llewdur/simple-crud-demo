@component('mail::message')
Hi {{ $name }}

Welcome :)

Thanks,<br>
{{ config('app.name') }}
@endcomponent
