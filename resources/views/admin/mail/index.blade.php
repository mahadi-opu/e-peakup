@extends('layouts.backend')

@section('title', 'Mails')

@section('content')
	
	<div class="md-card uk-margin-medium-bottom">

		<div class="user_heading uk-sticky-placeholder" data-uk-sticky="{ top: 48, media: 960 }">
		    <div class="user_heading_content">
		        <h2 class="heading_b">
	        		<span>List of Mails</span>
		        </h2>
		    </div>
		</div>

	    <div class="md-card-content">
	    	<div class="dt_colVis_buttons"></div>
            <table id="dt_tableExport" class="uk-table uk-table-hover" cellspacing="0" width="100%">
	            <thead>
		            <tr>
		            	<th>#</th>
		            	<th>Subject</th>
		            	<th>Message</th>
		                <th>Actions</th>
		            </tr>
	            </thead>

	            <tfoot>
		            <tr>
		            	<th>#</th>
		            	<th>Subject</th>
		            	<th>Message</th>
		                <th>Actions</th>
		            </tr>
	            </tfoot>

	            <tbody>
	            @foreach ($mails as $mail)
		            <tr>
		                <td>{{ $loop->index+1 }}</td>
		                <td>{{ $mail->subject }}</td>
		                <td style="width: 60%">{!! $mail->message !!}</td>
		                <td>
		                	<a data-uk-modal="{target: '#editModal{{ $mail->id }}'}"><i class="material-icons uk-text-primary md-icon" data-uk-tooltip title="Edit">create</i></a>
		                	<a href="{{ route('admin_mail_delete', $mail->id) }}" onclick="deleterow(this); return false"><i class="material-icons uk-text-danger md-icon" data-uk-tooltip title="Delete">delete</i></a>
		                </td>
		            </tr>
	            @endforeach
	            </tbody>
	        </table>
	    </div>
	</div>

	<div class="md-fab-wrapper">
        <a data-uk-modal="{target:'#createModal'}" class="md-fab md-fab-accent">
            <i class="material-icons">add</i>
        </a>
    </div>

    {{-- Create Modal --}}
	<div class="uk-modal create_modal" id="createModal">
    	<div class="user_heading">
		    <div class="user_heading_content">
		        <h2 class="heading_b uk-text-center"><span>Add A Mail</span></h2>
		    </div>
		</div>
        <div class="uk-modal-dialog">
            <button type="button" class="uk-modal-close uk-close"></button>
            <form method="post" action="{{ route('admin_mail_store') }}" enctype="multipart/form-data">
            	@csrf

            	<div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
	                    <label for="subject" class="uk-vertical-align-middle uk-text-bold">Subject:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <label for="subject">Subject</label>
	                    <input class="md-input" type="text" id="subject" name="subject" value="{{ old('subject') }}" required="">
	                    @error('subject')
	                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
	                    @enderror
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
	                    <label for="message" class="uk-vertical-align-middle uk-text-bold">Message:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <textarea id="message" name="message" class="md-input">{{ old('message') }}</textarea>
	                    @error('message')
	                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
	                    @enderror
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-text-right">
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <button type="submit" class="md-btn md-btn-primary">Submit</button>
	                </div>
	            </div>

            </form>

        </div>
    </div>

    {{-- Edit Modal --}}
    @foreach ($mails as $mail)
		<div class="uk-modal" id="editModal{{ $mail->id }}">
			<div class="user_heading">
			    <div class="user_heading_content">
			        <h2 class="heading_b uk-text-center"><span>{{ $mail->name }}</span></h2>
			    </div>
			</div>
	        <div class="uk-modal-dialog">
	            <button type="button" class="uk-modal-close uk-close"></button>
	            <form method="post" action="{{ route('admin_mail_update', $mail->id) }}" enctype="multipart/form-data">
	            	@csrf
	            	@method('PUT')

	            	<div class="uk-grid" data-uk-grid-margin>
		                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
		                    <label for="subject" class="uk-vertical-align-middle uk-text-bold">Subject:</label>
		                </div>
		                <div class="uk-width-medium-4-5">
		                    <label for="subject">Subject</label>
		                    <input class="md-input" type="text" id="subject" name="subject" value="{{ $mail->subject }}" required="">
		                    @error('subject')
		                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
		                    @enderror
		                </div>
		            </div>

		            <div class="uk-grid" data-uk-grid-margin>
		                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
		                    <label for="message" class="uk-vertical-align-middle uk-text-bold">Message:</label>
		                </div>
		                <div class="uk-width-medium-4-5">
		                    <textarea id="message" name="message" class="md-input">{{ $mail->message }}</textarea>
		                    @error('message')
		                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
		                    @enderror
		                </div>
		            </div>

		            <div class="uk-grid" data-uk-grid-margin>
		                <div class="uk-width-medium-1-5 uk-text-right">
		                </div>
		                <div class="uk-width-medium-4-5">
		                    <button type="submit" class="md-btn md-btn-primary">Submit</button>
		                </div>
		            </div>

	            </form>

	        </div>
	    </div>
    @endforeach

@endsection

@section('scripts')

	<script type="text/javascript">
		$('.sidebar_emails').addClass('current_section');
	</script>

@endsection