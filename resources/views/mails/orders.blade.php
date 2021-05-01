@component('mail::message')
Hello **{{Auth::user()->name}}**,  {{-- use double space for line break --}}
Thank you for choosing Mailtrap!

Click below to start working right now
@component('mail::button', ['url' => $link])
Go to your inbox
@endcomponent
Sincerely,  
Mailtrap team.
@endcomponent