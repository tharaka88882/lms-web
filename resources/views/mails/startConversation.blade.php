@component('mail::message')
# Mentee has started a conversation

Hi {{ $user_name }},</br>
Mentee has started a conversation with you.

@component('mail::button', ['url' => 'https://login.you2mentor.com/'])
Go to You2Mentor
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
