@component('mail::message')
    # E-mail Notification

    Coordinator {{ $data['coordinator'] }} has set your Application Status to {{ $data['status'] }}
    Assessment Status : {{ $data['assessment'] }}
    Message: {{ $data['message'] }}

    Thanks,
    ZIP Travel PH
@endcomponent
