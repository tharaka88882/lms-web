@component('mail::message')
# Welcome to You2Mentor

To verify your Email, please use the code below.

        {{ $code }}


Need help?
@component('mail::button', ['url' => 'https://you2mentor.com/contact/'])
    Contact Us
@endcomponent

If you didn't register an account with us, please ignore this email.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
