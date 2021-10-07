@component('mail::message')
# Welcome to 

Wlcome to LightHub

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
