@component('mail::message')

# Good News! Your money transfer is complete

Dear <strong>{{ $order->recipient->name }}</strong>,<br>
Your money transfer has reached the final step.<br>

For reference, here are the money transfer details:<br>

@component('mail::table')
<table>

<tr>
<td width="40%"><span style="color: #f79828;">Order Number : </span></td>
<td><a href="{{ route('login') }}">#OD{{ $order->order_id }}</a></td>
</tr>

<tr>
<td><span style="color: #f79828;">Amount Sent : </span></td>
<td><strong>{{ $order->amount }} AUD</strong></td>
</tr>

<tr>
<td><span style="color: #f79828;">Amount Received : </span></td>
<td><strong>{{ $order->recipient_amount }} BDT</strong></td>
</tr>

<tr>
<td><span style="color: #f79828;">Recipient Name : <span style="color: #f79828;"></td>
<td><strong>{{ $order->recipient->name }}</strong></td>
</tr>

</table>
@endcomponent

To access your final receipt, click your order number and log in to your account.

<div style="text-align: center;">
Thanks,<br>
{{ config('app.name') }} Support Team<br><br>
<a href="{{ url('/') }}/#contactUs">Contact Us</a> ||
<a href="{{ route('login') }}">Manage Account</a>
</div>
@endcomponent
