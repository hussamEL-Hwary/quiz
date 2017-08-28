@component('mail::message')
# Introduction
#Hi, {{$teacher->first_name }} 
Thinks for Registeration.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
