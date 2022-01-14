@component('mail::message')
# {{ $mailData['title'] }}
You've just created a new {{ Str::upper(config('app.name')) }} account. Please confirm your email address to let us know you're the rightful owner of this account.
@component('mail::button',['url'=>$mailData['url']])
Confirm my Email Address
@endcomponent
Thanks,
{{ Str::upper(config('app.name')) }}
@endcomponent