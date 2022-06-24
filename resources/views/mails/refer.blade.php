@component('mail::message')
# Hello!

{{ $username }} has referred you to join You2Mentor, a platform for peer to peer mentoring and development

@component('mail::button', ['url' => 'https://you2mentor.com/'])
Go to You2Mentor
@endcomponent

If you are already a member, please ignore this email.



Thanks,<br>
{{ config('app.name') }}
@endcomponent
