@component('mail::message')
# Money Order

For reference, here are the money transfer details:

@component('mail::table')
<table>

<tr>
<td><span style="color: #f79828;">Order Number : </span></td>
<td><strong>{!! $order->order_id !!}</strong></td>
</tr>

<tr>
<td><span style="color: #f79828;">Sender Name : </span></td>
<td><strong>{{ $order->user->name }}</strong></td>
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
<td><span style="color: #f79828;">Paid By : </span></td>
<td><strong>{{ strtoupper($order->payment_method_global) }}</strong></td>
</tr>

<tr>
<td><span style="color: #f79828;">Amount Received : </span></td>
<td><strong>{{ $order->recipient_amount }} BDT</strong></td>
</tr>

<tr>
<td><span style="color: #f79828;">Account Number : </span></td>
<td><strong>{{ $order->recipient->number }}</strong></td>
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

<tr>
<td><span style="color: #f79828;">Exchange Rate : </span></td>
<td><strong>{{ number_format($order->rate, 2) }} BDT</strong></td>
</tr>

<tr>
<td><span style="color: #f79828;">Date & Time : </span></td>
<td><strong>{{ $order->created_at->format('F d, Y - h:i A') }}</strong></td>
</tr>

</table>
@endcomponent

@component('mail::button', ['url' => url('admin/login')])
Admin Login
@endcomponent

@endcomponent
