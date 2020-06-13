@component('mail::message')
    Hi,Cleaner {{$cleaner}} completed {{$task}} of {{$client}}. Please proceed with the invoice.
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent