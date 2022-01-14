@component('mail::message')
# {{ $mailData['title'] }}
You are receiving this email because we received a password reset request for your account.
@component('mail::code', ['code'=>$mailData['code']])
@endcomponent
Thanks,
{{ Str::upper(config('app.name')) }}
@endcomponent