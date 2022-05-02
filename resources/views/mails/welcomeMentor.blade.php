@component('mail::message')
# Registration Successful

You successfully registered as a Mentor at You2Mentor.com.

@component('mail::button', ['url' => 'https://login.you2mentor.com/'])
Go to You2Mentor
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
