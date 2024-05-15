{{-- blade-formatter-disable --}}
@component('mail::message')

Dear {{ $user->full_name }},

Good Day!

@if($user->is_activated == 0)
Unfortunatetly there are circumstances that you did not totally comply and the administrator choses to deactivate your account.
@endif

@if($user->is_activated == 1)
Your account is now activated. You can now use our platform just click the button below to redirect.
@endif

Any Questions? You can visit our frequently asked question page or email us at virgilio.handicraft2@gmail.com

@component('mail::button', ['url' => $url])
Redirect
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
