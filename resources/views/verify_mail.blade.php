@component('mail::message')
# Verification Email

The verification code is:{{$user->verify_code}}

{{--@component('mail::button', ['url' => ''])--}}

{{--@endcomponent--}}

Thanks,<br>
Pure Code
{{--{{ config('app.name') }}--}}
@endcomponent
