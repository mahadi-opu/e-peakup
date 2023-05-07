@extends('layouts.backend')

@section('title', 'Services')

@section('content')
	
	<div class="md-card uk-margin-medium-bottom">

		<div class="user_heading uk-sticky-placeholder" data-uk-sticky="{ top: 48, media: 960 }">
		    <div class="user_heading_content">
		        <h2 class="heading_b">
	        		<span>List of Services</span>
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
		                <th>Actions</th>
		            </tr>
	            </thead>

	            <tfoot>
		            <tr>
		            	<th>#</th>
		            	<th>Name</th>
		                <th>Actions</th>
		            </tr>
	            </tfoot>

	            <tbody>
	            @foreach ($services as $service)
		            <tr>
		                <td>{{ $loop->index+1 }}</td>
		                <td>{{ $service->name }}</td>
		                <td>
		                	<a data-uk-modal="{target: '#editModal{{ $service->id }}'}"><i class="material-icons uk-text-primary md-icon" data-uk-tooltip title="Edit">create</i></a>
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
		        <h2 class="heading_b uk-text-center"><span>Add Service</span></h2>
		    </div>
		</div>
        <div class="uk-modal-dialog">
            <button type="button" class="uk-modal-close uk-close"></button>
            <form method="post" action="{{ route('admin_service_store') }}" enctype="multipart/form-data">
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
	                    <label for="charge" class="uk-vertical-align-middle uk-text-bold">Charge:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <label for="charge">Charge</label>
	                    <input class="md-input" type="number" id="charge" name="charge" value="{{ old('charge') }}" required="">
	                    @error('charge')
	                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
	                    @enderror
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
	                    <label for="country_id" class="uk-vertical-align-middle uk-text-bold">Country:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <label for="country_id">Country</label>
	                    <select name="country_id" required="">
	                    	<option value="">Select...</option>
	                    	@foreach ($countries as $country)
		                    	<option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
	                    	@endforeach
	                    </select>
	                    @error('country_id')
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
    @foreach ($services as $service)
		<div class="uk-modal" id="editModal{{ $service->id }}">
			<div class="user_heading">
			    <div class="user_heading_content">
			        <h2 class="heading_b uk-text-center"><span>{{ $service->name }}</span></h2>
			    </div>
			</div>
	        <div class="uk-modal-dialog">
	            <button type="button" class="uk-modal-close uk-close"></button>
	            <form method="post" action="{{ route('admin_service_update', $service->id) }}" enctype="multipart/form-data">
	            	@csrf
	            	@method('PUT')

		            <div class="uk-grid" data-uk-grid-margin>
		                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
		                    <label for="name{{ $service->id }}" class="uk-vertical-align-middle uk-text-bold">Name:</label>
		                </div>
		                <div class="uk-width-medium-4-5">
		                    <label for="name">Name</label>
		                    <input class="md-input" type="text" id="name{{ $service->id }}" name="name" value="{{ $service->name }}" required="">
		                    @error('name')
		                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
		                    @enderror
		                </div>
		            </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
                            <label for="charge" class="uk-vertical-align-middle uk-text-bold">Charge:</label>
                        </div>
                        <div class="uk-width-medium-4-5">
                            <label for="charge">Charge</label>
                            <input class="md-input" type="number" id="charge" name="charge" value="{{ $service->charge }}" required="">
                            @error('charge')
                                <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
                            <label for="country_id" class="uk-vertical-align-middle uk-text-bold">Country:</label>
                        </div>
                        <div class="uk-width-medium-4-5">
                            <label for="country_id">Country</label>
                            <select name="country_id" required="">
                            	<option value="">Select...</option>
                            	@foreach ($countries as $country)
        	                    	<option value="{{ $country->id }}" {{ $service->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                            	@endforeach
                            </select>
                            @error('country_id')
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
		$('.sidebar_services').addClass('current_section');
	</script>

@endsection