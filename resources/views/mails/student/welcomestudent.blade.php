@component('mail::message')
# Introduction

# Hello, {{$student->first_name}}

Thanks for registeration.

@component('mail::button', ['url' => 'http://localhost:8000/'])
QuizApp
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
