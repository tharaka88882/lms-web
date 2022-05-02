@component('mail::message')
# Greetings!

{{ $username }} has refered you to join You2Mentor.com

@component('mail::button', ['url' => 'https://you2mentor.com/'])
Go to You2Mentor
@endcomponent

If you are already a member, Ignore this.



Thanks,<br>
{{ config('app.name') }}
@endcomponent
