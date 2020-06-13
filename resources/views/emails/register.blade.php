@component('mail::message')
    # Introduction

    We have created your {{$type}} account with your email. Here is your password: {{$password}}

    Thanks,

    {{ config('app.name') }}
@endcomponent
