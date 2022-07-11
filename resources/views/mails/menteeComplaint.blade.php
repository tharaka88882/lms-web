@component('mail::message')
# Hi (username)

A Mentee has flagged a complaint as below:
<br>
Reson (what mentee selected in the combo box)
<br>
We will review and get back to you if there are any further actions required from you.
<br>
Please note, if there are 3 complaints flagged against your profile, your account may be blocked.

From,<br>
{{ config('app.name') }}
@endcomponent
