@component('mail::message')
# Hi {{ explode('-',$name)[0] }}

A Mentee has flagged a complaint as below:
<br>
<br>
Reson - {{ explode('-',$name)[1] }}
<br>
<br>
We will review and get back to you if there are any further actions required from you.
<br>
Please note, if there are 3 complaints flagged against your profile, your account may be blocked.

From,<br>
{{ config('app.name') }}
@endcomponent
