@component('mail::message')
# Welcome to You2Mentor

Hi!
To verify your Email, please use the code below.

        {{ $code }}

Please note, this link expires in 28 days.


Need help? Please Contact us.

If you didn't register an account with us, please ignore this email";


Thanks,<br>
{{ config('app.name') }}
@endcomponent
