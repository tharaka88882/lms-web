@component('mail::message')
# Welcome to You2Mentor

Hi {{ $username }}!

Thanks for siging up with You2Mentor.
Your potal for self development and peer to peer Mentoring.
Now you can add You2Mentor to your phone, Tablet and desktop.
@component('mail::button', ['url' => 'https://login.you2mentor.com/user/dashboard'])
Click Here
@endcomponent

{{-- Thanks,<br>
{{ config('app.name') }} --}}
@endcomponent
