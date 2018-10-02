@component('mail::message')
# ZIP Travel PH

Name: {{ $data['name'] }}<br>
Subject: {{ $data['subject'] }}<br>
Email: {{ $data['email'] }}<br>

Message: {{ $data['message'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
