@component('mail::message')
# Mentee has started a conversation

Hi {{ explode(',',$user_name)[0] }}, {{ explode(',',$user_name)[1] }} has started a conversation with you.

@component('mail::button', ['url' => 'https://login.you2mentor.com/'])
        Go to You2Mentor
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
