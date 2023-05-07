@extends('layouts.backend')

@section('title', 'Payment Methods')

@section('content')
	
	<div class="md-card uk-margin-medium-bottom">

		<div class="user_heading uk-sticky-placeholder" data-uk-sticky="{ top: 48, media: 960 }">
		    <div class="user_heading_content">
		        <h2 class="heading_b">
	        		<span>List of Payment Methods</span>
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
		                <th>Actions</th>
		            </tr>
	            </thead>

	            <tfoot>
		            <tr>
		            	<th>#</th>
		            	<th>Name</th>
		            	<th>Image</th>
		                <th>Actions</th>
		            </tr>
	            </tfoot>

	            <tbody>
	            @foreach ($payment_methods as $method)
		            <tr>
		                <td>{{ $loop->index+1 }}</td>
		                <td>{{ $method->name }}</td>
		                <td>
		                	<img src="{{ asset($method->image) }}" width="100px">
		                </td>
		                <td>
		                	<a data-uk-modal="{target: '#editModal{{ $method->id }}'}"><i class="material-icons uk-text-primary md-icon" data-uk-tooltip title="Edit">create</i></a>
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

	<div class="uk-modal" id="createModal">
    	<div class="user_heading">
		    <div class="user_heading_content">
		        <h2 class="heading_b uk-text-center"><span>Add Service</span></h2>
		    </div>
		</div>
        <div class="uk-modal-dialog">
            <button type="button" class="uk-modal-close uk-close"></button>
            <form method="post" action="{{ route('admin_payment_method_store') }}" enctype="multipart/form-data">
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
	                    <label for="image">Image</label>
	                    <input class="dropify" type="file" id="image" name="image" required="">
	                    @error('image')
	                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
	                    @enderror
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
	                    <label for="service_id" class="uk-vertical-align-middle uk-text-bold">Service:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <label for="service_id">Service</label>
	                    <select name="service_id" required="">
	                    	<option value="">Select...</option>
	                    	@foreach ($services as $service)
		                    	<option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
	                    	@endforeach
	                    </select>
	                    @error('service_id')
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
    @foreach ($payment_methods as $method)
		<div class="uk-modal" id="editModal{{ $method->id }}">
			<div class="user_heading">
			    <div class="user_heading_content">
			        <h2 class="heading_b uk-text-center"><span>{{ $method->name }}</span></h2>
			    </div>
			</div>
	        <div class="uk-modal-dialog">
	            <button type="button" class="uk-modal-close uk-close"></button>
	            <form method="post" action="{{ route('admin_payment_method_update', $method->id) }}" enctype="multipart/form-data">
	            	@csrf
	            	@method('PUT')

		            <div class="uk-grid" data-uk-grid-margin>
		                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
		                    <label for="name{{ $method->id }}" class="uk-vertical-align-middle uk-text-bold">Name:</label>
		                </div>
		                <div class="uk-width-medium-4-5">
		                    <label for="name">Name</label>
		                    <input class="md-input" type="text" id="name{{ $method->id }}" name="name" value="{{ $method->name }}" required="">
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
		                    <label for="image">Image</label>
		                    <input class="dropify" type="file" id="image" name="image" data-default-file="{{ $service->image }}" required="">
		                    @error('image')
		                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
		                    @enderror
		                </div>
		            </div>

		            <div class="uk-grid" data-uk-grid-margin>
		                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
		                    <label for="service_id" class="uk-vertical-align-middle uk-text-bold">Service:</label>
		                </div>
		                <div class="uk-width-medium-4-5">
		                    <label for="service_id">Service</label>
		                    <select name="service_id" required="">
		                    	<option value="">Select...</option>
		                    	@foreach ($services as $service)
			                    	<option value="{{ $service->id }}" {{ $method->service_id == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
		                    	@endforeach
		                    </select>
		                    @error('service_id')
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
		$('.sidebar_payment_methods').addClass('current_section');
	</script>

@endsection