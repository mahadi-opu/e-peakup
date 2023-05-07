@extends('layouts.backend')

@section('title', 'Offers')

@section('content')
	
	<div class="md-card uk-margin-medium-bottom">

		<div class="user_heading uk-sticky-placeholder" data-uk-sticky="{ top: 48, media: 960 }">
		    <div class="user_heading_content">
		        <h2 class="heading_b">
	        		<span>List of Offers</span>
		        </h2>
		    </div>
		</div>

	    <div class="md-card-content">
	    	<div class="dt_colVis_buttons"></div>
            <table id="dt_tableExport" class="uk-table uk-table-hover" cellspacing="0" width="100%">
	            <thead>
		            <tr>
		            	<th>#</th>
		            	<th>Rate</th>
		            	<th>Highlighted Text</th>
		            	<th>Created At</th>
		                <th>Actions</th>
		            </tr>
	            </thead>

	            <tfoot>
		            <tr>
		            	<th>#</th>
		            	<th>Rate</th>
		            	<th>Highlighted Text</th>
		            	<th>Created At</th>
		                <th>Actions</th>
		            </tr>
	            </tfoot>

	            <tbody>
	            @foreach ($offers as $offer)
		            <tr>
		                <td>{{ $loop->index+1 }}</td>
		                <td>${{ number_format($offer->rate, 2) }}</td>
		                <td>{{ $offer->text }}</td>
		                <td>{{ $offer->created_at->format('F d, Y - h:i A') }}</td>
		                <td>
		                	<a data-uk-modal="{target: '#editModal{{ $offer->id }}'}"><i class="material-icons uk-text-primary md-icon" data-uk-tooltip title="Edit">create</i></a>
		                	<a href="{{ route('admin_offer_delete', $offer->id) }}" onclick="deleterow(this); return false"><i class="material-icons uk-text-danger md-icon" data-uk-tooltip title="Delete">delete</i></a>
		                </td>
		            </tr>
	            @endforeach
	            </tbody>
	        </table>
	    </div>
	</div>

	@if (!count($offers))
		<div class="md-fab-wrapper">
	        <a data-uk-modal="{target:'#createModal'}" class="md-fab md-fab-accent">
	            <i class="material-icons">add</i>
	        </a>
	    </div>
	@endif

	<div class="uk-modal" id="createModal">
    	<div class="user_heading">
		    <div class="user_heading_content">
		        <h2 class="heading_b uk-text-center"><span>Add Offer</span></h2>
		    </div>
		</div>
        <div class="uk-modal-dialog">
            <button type="button" class="uk-modal-close uk-close"></button>
            <form method="post" action="{{ route('admin_offer_store') }}" enctype="multipart/form-data">
            	@csrf

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
	                    <label for="rate" class="uk-vertical-align-middle uk-text-bold">Rate:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <label for="rate">Rate</label>
	                    <input class="md-input" type="number" id="rate" name="rate" value="{{ old('rate') }}" required="">
	                    @error('rate')
	                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
	                    @enderror
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
	                    <label for="text" class="uk-vertical-align-middle uk-text-bold">Text:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <label for="text">Text</label>
	                    <textarea class="md-input" id="text" name="text" required="">{{ old('text') }}</textarea>
	                    @error('text')
	                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
	                    @enderror
	                </div>
	            </div>

	            {{-- <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
	                    <label for="payment_method_id" class="uk-vertical-align-middle uk-text-bold">Payment Method:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <label for="payment_method_id">Payment Method</label>
	                    <select name="payment_method_id" required="">
	                    	<option value="">Select...</option>
	                    	@foreach ($payment_methods as $method)
	                    		@if (!in_array($method->id, $method_exists))
			                    	<option value="{{ $method->id }}" {{ old('payment_method_id') == $method->id ? 'selected' : '' }}>{{ $method->name }}</option>
	                    		@endif
	                    	@endforeach
	                    </select>
	                    @error('payment_method_id')
	                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
	                    @enderror
	                </div>
	            </div> --}}

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
    @foreach ($offers as $offer)
		<div class="uk-modal" id="editModal{{ $offer->id }}">
			<div class="user_heading">
			    <div class="user_heading_content">
			        <h2 class="heading_b uk-text-center"><span>{{ $offer->name }}</span></h2>
			    </div>
			</div>
	        <div class="uk-modal-dialog">
	            <button type="button" class="uk-modal-close uk-close"></button>
	            <form method="post" action="{{ route('admin_offer_update', $offer->id) }}" enctype="multipart/form-data">
	            	@csrf
	            	@method('PUT')

		            <div class="uk-grid" data-uk-grid-margin>
		                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
		                    <label for="rate" class="uk-vertical-align-middle uk-text-bold">Rate:</label>
		                </div>
		                <div class="uk-width-medium-4-5">
		                    <label for="rate">Rate</label>
		                    <input class="md-input" type="number" id="rate" name="rate" value="{{ $offer->rate }}" required="">
		                    @error('rate')
		                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
		                    @enderror
		                </div>
		            </div>

		            <div class="uk-grid" data-uk-grid-margin>
		                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
		                    <label for="text" class="uk-vertical-align-middle uk-text-bold">Text:</label>
		                </div>
		                <div class="uk-width-medium-4-5">
		                    <label for="text">Text</label>
		                    <textarea class="md-input" id="text" name="text" required="">{{ $offer->text }}</textarea>
		                    @error('text')
		                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
		                    @enderror
		                </div>
		            </div>

		            {{-- <div class="uk-grid" data-uk-grid-margin>
		                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
		                    <label for="payment_method_id" class="uk-vertical-align-middle uk-text-bold">Payment Method:</label>
		                </div>
		                <div class="uk-width-medium-4-5">
		                    <label for="payment_method_id">Payment Method</label>
		                    <select name="payment_method_id" required="">
		                    	<option value="">Select...</option>
		                    	@foreach ($payment_methods as $method)
		                    		@if (!in_array($method->id, $method_exists))
			                    		<option value="{{ $method->id }}" {{ $offer->payment_method_id == $method->id ? 'selected' : '' }}>{{ $method->name }}</option>
			                    	@endif
		                    	@endforeach
		                    </select>
		                    @error('payment_method_id')
		                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
		                    @enderror
		                </div>
		            </div> --}}

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
		$('.sidebar_offers').addClass('current_section');
	</script>

@endsection