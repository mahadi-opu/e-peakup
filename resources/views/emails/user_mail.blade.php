@component('mail::message')
# Quick Peakup: {{ $data['subject'] }}

{!! $data['message'] !!}

<div style="text-align: center;">
Thanks,<br>
{{ config('app.name') }} Support Team<br><br>
<a href="{{ url('/') }}/#contactUs">Contact Us</a> ||
<a href="{{ route('login') }}">Manage Account</a>
</div>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
