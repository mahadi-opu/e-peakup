@component('mail::message')

# Good News! Your money transfer is complete

Dear <strong>{{ $order->recipient->name }}</strong>,<br>
We have processed your money transfer.<br>

For reference, here are the money transfer details:<br>

@component('mail::table')
<table>

<tr>
<td width="40%"><span style="color: #f79828;">Order Number : </span></td>
<td><a href="{{ route('login') }}">#OD{{ $order->order_id }}</a></td>
</tr>

<tr>
<td><span style="color: #f79828;">Recipient Name : </span></td>
<td><strong>{{ $order->recipient->name }}</strong></td>
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
<td><span style="color: #f79828;">Delivery Method : </span></td>
<td><strong>{{ $order->payment_method->name }}</strong></td>
</tr>

<tr>
<td><span style="color: #f79828;">Delivery Charge : </span></td>
<td><strong>{{ ($order->grand_total - $order->amount) }} AUD</strong></td>
</tr>

<tr>
<td><span style="color: #f79828;">Total Paid : </span></td>
<td><strong>{{ $order->grand_total }} AUD</strong></td>
</tr>

</table>
@endcomponent

<div style="text-align: center;">
Thanks,<br>
{{ config('app.name') }} Support Team<br><br>
<a href="{{ url('/') }}/#contactUs">Contact Us</a> ||
<a href="{{ route('login') }}">Manage Account</a>
</div>
@endcomponent
