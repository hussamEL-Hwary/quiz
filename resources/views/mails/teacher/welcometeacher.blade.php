@component('mail::message')
# Introduction
#Hello, {{$teacher->first_name }}
Thinks for Registeration.

@component('mail::button', ['url' => 'http://localhost:8000/'])
QuizApp
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
