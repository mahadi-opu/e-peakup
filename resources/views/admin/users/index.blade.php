@extends('layouts.backend')

@section('title', 'Users')
	
@section('content')
	
	<div class="md-card uk-margin-medium-bottom">

		<div class="user_heading uk-sticky-placeholder" data-uk-sticky="{ top: 48, media: 960 }">
		    <div class="user_heading_content">
		        <h2 class="heading_b">
	        		<span>List of Users</span>
		        </h2>
		    </div>
		</div>

	    <div class="md-card-content">
	    	<div class="dt_colVis_buttons"></div>
            <table id="dt_tableExport" class="uk-table uk-table-hover" cellspacing="0" width="100%">
	            <thead>
		            <tr>
		            	<th>#</th>
		            	<th>Name</th>
		            	<th>Email</th>
		            	<th>Phone Number</th>
		            	<th>Gender</th>
		            	<th>Refers</th>
		            	<th>Status</th>
		            	<th>Registered At</th>
		                <th>Actions</th>
		            </tr>
	            </thead>

	            <tbody>
	            @foreach ($users as $user)
		            <tr>
		                <td>{{ $loop->index+1 }}</td>
		                <td>{{ $user->name }}</td>
		                <td>{{ $user->email }}</td>
		                <td>{{ $user->phone }}</td>
		                <td>{{ ucfirst($user->gender) }}</td>
		                <td>{{ $user->refers }}</td>
		                <td>
		                	@if ($user->email_verified_at)
		                		<span class="uk-badge uk-badge-success">Verified</span>
		                	@else
		                		<span class="uk-badge uk-badge-warning">Not Verified Yet</span>
		                	@endif
		                </td>
		                <td>{{ $user->created_at->format('F d, Y - h:i A') }}</td>
		                <td>
		                	<a data-uk-modal="{target: '#viewModal{{ $user->id }}'}">
		                		<i class="material-icons uk-text-primary md-icon" data-uk-tooltip title="Edit">visibility</i>
		                	</a>
		                	<a data-uk-modal="{target: '#sendMailModal{{ $user->id }}'}">
		                		<i class="material-icons uk-text-warning md-icon" data-uk-tooltip title="Send">email</i>
		                	</a>
		                	<a href="{{ route('admin_users_destroy', $user->id) }}" onclick="deleterow(this); return false"><i class="material-icons uk-text-danger md-icon" data-uk-tooltip title="Delete along with Orders and Recipients">delete</i></a>
		                </td>
		            </tr>
	            @endforeach
	            </tbody>
	        </table>
	    </div>
	</div>

	@foreach ($users as $user)
		<div class="uk-modal create_modal" id="viewModal{{ $user->id }}">
	    	<div class="user_heading">
			    <div class="user_heading_content">
			        <h2 class="heading_b uk-text-center"><span>{{ $user->name }}</span></h2>
			    </div>
			</div>
	        <div class="uk-modal-dialog">
	            <button type="button" class="uk-modal-close uk-close"></button>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Status:</label>
	                </div>
	                <div class="uk-width-medium-3-5">
	                    @if ($user->email_verified_at)
	                		<span class="uk-badge uk-badge-success">Verified</span>
	                	@else
	                		<span class="uk-badge uk-badge-success">Not Verified Yet</span>
	                	@endif
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Name:</label>
	                </div>
	                <div class="uk-width-medium-3-5">
	                    {{ $user->name }}
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Email:</label>
	                </div>
	                <div class="uk-width-medium-3-5">
	                    {{ $user->email }}
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Phone:</label>
	                </div>
	                <div class="uk-width-medium-3-5">
	                    {{ $user->phone }}
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Gender:</label>
	                </div>
	                <div class="uk-width-medium-3-5">
	                    {{ ucfirst($user->gender) }}
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Address:</label>
	                </div>
	                <div class="uk-width-medium-3-5">
	                    {{ $user->address }}
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Registered At:</label>
	                </div>
	                <div class="uk-width-medium-3-5">
	                    {{ $user->created_at }}
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Country:</label>
	                </div>
	                <div class="uk-width-medium-3-5">
	                    {{ $user->country->name }}
	                </div>
	            </div>

	        </div>
	    </div>

	    @foreach ($users as $user)
	    	<div class="uk-modal" id="sendMailModal{{ $user->id }}">
				<div class="user_heading">
				    <div class="user_heading_content">
				        <h2 class="heading_b uk-text-center"><span>Send Mail</span></h2>
				    </div>
				</div>
		        <div class="uk-modal-dialog uk-modal-dialog-large">
		            <button type="button" class="uk-modal-close uk-close"></button>

		            <form method="post" action="{{ route('admin_users_send_mail', $user->id) }}">
		            	@csrf

			            <div class="uk-grid">
			            	<div class="uk-width-medium-1-4 uk-vertical-align uk-text-right">
			                    <label class="uk-vertical-align-middle uk-text-bold">Email:</label>
			                </div>
			                <div class="uk-width-medium-3-4">
			                	<select class="select_subject" data-user="{{ $user->id }}">
			                		<option value="">Select...</option>
			                		@foreach ($mails as $mail)
			                			<option value="{{ $mail->id }}">{{ $mail->subject }}</option>
			                		@endforeach
			                	</select>
			                </div>
			            </div>

			            <div class="uk-grid">
			            	<div class="uk-width-medium-1-4 uk-vertical-align uk-text-right">
			                    <label class="uk-vertical-align-middle uk-text-bold">Subject:</label>
			                </div>
			                <div class="uk-width-medium-3-4">
			                	<input type="text" class="md-input" name="subject" id="subject{{ $user->id }}">
			                </div>
			            </div>

			            <div class="uk-grid">
			            	<div class="uk-width-medium-1-4 uk-vertical-align uk-text-right">
			                    <label class="uk-vertical-align-middle uk-text-bold">Message:</label>
			                </div>
			                <div class="uk-width-medium-3-4">
			                	<textarea id="message{{ $user->id }}" rows="6" class="md-input" name="message"></textarea>
			                </div>
			            </div>

			            <div class="uk-grid">
			            	<div class="uk-width-medium-1-4 uk-vertical-align uk-text-right"></div>
			                <div class="uk-width-medium-3-4">
			                	<button type="submit" class="md-btn md-btn-success">Send</button>
			                </div>
			            </div>
		            </form>

		        </div>
		    </div>

		    @foreach ($mails as $mail)
			    <textarea id="select_message{{ $mail->id }}" style="display: none">{{ $mail->message }}</textarea>
		    @endforeach

	    @endforeach

    @endforeach

@endsection

@section('scripts')

	<script type="text/javascript">
		$('.sidebar_users').addClass('current_section');

		$(document).on('change', '.select_subject', function() {
			var user_id = $(this).data('user');
			var mail_id = $(this).val();
			var subject = $(this).text();
			var message = $('#select_message'+mail_id).html();
			$('#subject'+user_id).val(subject);
			$('#message'+user_id).text(message);
		});
	</script>

@endsection