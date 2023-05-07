@extends('layouts.backend')

@section('title', 'Global Payment Methods')

@section('content')
	
	<div class="md-card uk-margin-medium-bottom">

		<div class="user_heading uk-sticky-placeholder" data-uk-sticky="{ top: 48, media: 960 }">
		    <div class="user_heading_content">
		        <h2 class="heading_b">
	        		<span>Global Payment Methods</span>
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
		            	<th>Image</th>
		            	<th>Status</th>
		                <th>Actions</th>
		            </tr>
	            </thead>

	            <tfoot>
		            <tr>
		            	<th>#</th>
		            	<th>Name</th>
		            	<th>Image</th>
		            	<th>Status</th>
		                <th>Actions</th>
		            </tr>
	            </tfoot>

	            <tbody>
	            @foreach ($global_payments as $payment)
		            <tr>
		                <td>{{ $loop->index+1 }}</td>
		                <td>{{ $payment->name }}</td>
		                <td>
		                	<a href="{{ asset($payment->image) }}" data-uk-lightbox data-uk-tooltip title="View full image">
		                		<img src="{{ asset($payment->image) }}" width="60" alt="Not found">
		                	</a>
		                </td>
		                <td>
		                	@if ($payment->status)
		                		<span class="uk-badge uk-badge-success">Active</span>
		                	@else
		                		<span class="uk-badge uk-badge-danger">Inctive</span>
		                	@endif
		                </td>
		                <td>
		                	<a data-uk-modal="{target: '#editModal{{ $payment->id }}'}"><i class="material-icons uk-text-primary md-icon" data-uk-tooltip title="Edit">create</i></a>
		                	<a href="{{ route('admin_global_payments_delete', $payment->id) }}" onclick="deleterow(this); return false"><i class="material-icons uk-text-danger md-icon" data-uk-tooltip title="Delete">delete</i></a>
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
		        <h2 class="heading_b uk-text-center"><span>Add an Image</span></h2>
		    </div>
		</div>
        <div class="uk-modal-dialog">
            <button type="button" class="uk-modal-close uk-close"></button>
            <form method="post" action="{{ route('admin_global_payments_store') }}" enctype="multipart/form-data">
            	@csrf

            	<div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
	                    <label for="name" class="uk-vertical-align-middle uk-text-bold">Name:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <label for="name">Name</label>
	                    <input class="md-input" type="text" id="name" name="name" value="{{ old('name') }}" required="">
	                    @error('name')
	                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
	                    @enderror
	                </div>
	            </div>

            	<div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
	                    <label for="image" class="uk-vertical-align-middle uk-text-bold">Image:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <input class="dropify" type="file" id="image" name="image" data-default-file="{{ old('image') }}" required="">
	                    @error('image')
	                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
	                    @enderror
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
	                    <label for="status" class="uk-vertical-align-middle uk-text-bold">Status:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <input type="checkbox" name="status" data-switchery checked id="status" value="1">
                        <label for="status" class="inline-label">Status</label>
	                    @error('status')
	                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
	                    @endif
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
    @foreach ($global_payments as $payment)
		<div class="uk-modal" id="editModal{{ $payment->id }}">
			<div class="user_heading">
			    <div class="user_heading_content">
			        <h2 class="heading_b uk-text-center"><span>{{ $payment->title }}</span></h2>
			    </div>
			</div>
	        <div class="uk-modal-dialog">
	            <button type="button" class="uk-modal-close uk-close"></button>
	            <form method="post" action="{{ route('admin_global_payments_update', $payment->id) }}" enctype="multipart/form-data">
	            	@csrf
	            	@method('PUT')

	            	<div class="uk-grid" data-uk-grid-margin>
		                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
		                    <label for="name" class="uk-vertical-align-middle uk-text-bold">Name:</label>
		                </div>
		                <div class="uk-width-medium-4-5">
		                    <label for="name">Name</label>
		                    <input class="md-input" type="text" id="name" name="name" value="{{ $payment->name }}" required="">
		                    @error('name')
		                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
		                    @enderror
		                </div>
		            </div>

	            	<div class="uk-grid" data-uk-grid-margin>
		                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
		                    <label for="image{{ $payment->id }}" class="uk-vertical-align-middle uk-text-bold">Image:</label>
		                </div>
		                <div class="uk-width-medium-4-5">
		                    <input class="dropify" type="file" id="image{{ $payment->id }}" name="image" data-default-file="{{ asset($payment->image) }}">
		                    @error('image')
		                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
		                    @enderror
		                </div>
		            </div>

		            <div class="uk-grid" data-uk-grid-margin>
		                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
		                    <label for="status" class="uk-vertical-align-middle uk-text-bold">Status:</label>
		                </div>
		                <div class="uk-width-medium-4-5">
		                    <input type="checkbox" name="status" data-switchery {{ $payment->status ? 'checked' : '' }} value="1">
	                        <label for="status" class="inline-label">Status</label>
		                    @error('status')
		                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
		                    @endif
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
		$('.sidebar_cms').addClass('current_section');
	</script>

@endsection