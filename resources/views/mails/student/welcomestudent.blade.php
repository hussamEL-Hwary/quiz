@component('mail::message')
# Introduction

# Hi, {{$student->first_name}}
please informe us if you are gaعw.
The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
