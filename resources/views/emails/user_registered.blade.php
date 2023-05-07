@component('mail::message')
# New User Registered

Dear <strong>QuickPeakup</strong>, A new user has registered on QuickPeakup. Details are:

@component('mail::table')
<table>
<tr>
<td><span style="color: #f79828;">Customer Id : </span></td>
<td><strong>{!! $user->customer_id !!}</strong></td>
</tr>
<tr>
<td><span style="color: #f79828;">Name : </span></td>
<td><strong>{{ $user->name }}</strong></td>
</tr>
<tr>
<td><span style="color: #f79828;">Phone : </span></td>
<td><strong>{{ $user->phone }}</strong></td>
</tr>
<tr>
<td><span style="color: #f79828;">Email : </span></td>
<td><strong>{{ $user->email }}</strong></td>
</tr>
<tr>
<td><span style="color: #f79828;">Country : </span></td>
<td><strong>{{ $user->country->name }}</strong></td>
</tr>
<tr>
</table>
@endcomponent

@endcomponent
