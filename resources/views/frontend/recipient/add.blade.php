@extends('layouts/frontend')

@section('title', 'Add Recipient')

@section('content')
	<div class="container">
    <h2 class="font-weight-400 text-center mt-3">Recipient Details</h2>
    <div class="row">
      <div class="col-md-8 col-lg-6 col-xl-8 mx-auto">
		<form method="post" action="{{ route('frontend_recipient_save') }}">
    			@csrf
          <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
	          <h3 class="text-5 font-weight-400 mb-3">Account Details</h3>

	        	<div class="form-group">
    				<label for="selectService">Country</label>
	        		<span class="input-group-text p-0">
	            		<select id="selectService" name="country_id" data-style="custom-select bg-transparent border-0" data-container="body" class="selectpicker form-control bg-transparent" required="">
	            			<option disabled selected value="2">Bangladesh</option>
	        			</select>
	        		</span>
	        		@error('country_id')
	        			<span class="text-danger">{{ $message }}</span>
        			@enderror
	        	</div>

	        	<div class="form-group">
	    			<label for="selectService">{{ $data['payment_method']['name'] }} Number</label>
	    			<div class="input-group">
	        			<div class="input-group-prepend">
	        				<span class="input-group-text">+88</span>
	        			</div>
	            		<span class="input-group-text p-0">
		            		<input type="tel" class="form-control" name="number" min="11" max="11" pattern="{{ $data['payment_method']['regex'] }}" placeholder="{{ $data['payment_method']['name'] }} Number" value="{{ $recipient && $recipient->number ? $recipient->number : old('number') }}" required>
		        		</span>
	    			</div>
	    			@error('number')
	        			<span class="text-danger">{{ $message }}</span>
        			@enderror
	        	</div>

	        	<div class="form-group">
	    			<label for="selectService">Confirm Number</label>
	    			<div class="input-group">
	        			<div class="input-group-prepend">
	        				<span class="input-group-text">+88</span>
	        			</div>
	            		<span class="input-group-text p-0">
		            		<input type="text" class="form-control" name="number_confirmation" min="11" max="11" pattern="{{ $data['payment_method']['regex'] }}" placeholder="Confirm Number" value="{{ $recipient && $recipient->number ? $recipient->number : old('number') }}" required>
		        		</span>
	    			</div>
	        	</div>

	        	@if ($data['show_type_status'])
	        		<div class="form-group">
	        			<label for="selectType">{{ $data['payment_method']['name'] }} Type</label>
	          			<span class="input-group-text p-0">
	            			<select id="selectType" name="type_id" data-style="custom-select bg-transparent border-0" data-container="body" class="selectpicker form-control bg-transparent" required="">
		            			@foreach ($types as $type)
		            				<option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }} @if($type->percentage) <span>(with {{ $type->percentage }}% extra charge with total amount)</span> @endif </option>
		            			@endforeach
		        			</select>
		        		</span>
		        		@error('type_id')
		        			<span class="text-danger">{{ $message }}</span>
	        			@enderror
	          		</div>
	        	@endif
          </div>

          <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
	          <h3 class="text-5 font-weight-400 mb-3">Personal Details</h3>

	        	<div class="form-group">
    				<label for="name">Name</label>
	        		<span class="input-group-text p-0">
	            		<input type="text" class="form-control" data-bv-field="name" id="name" name="name" placeholder="Name" value="{{ $recipient && $recipient->name ? $recipient->name : old('name') }}" required {{ $recipient_exist ? 'readonly' : '' }}>
	        		</span>
	        		@error('name')
	        			<span class="text-danger">{{ $message }}</span>
        			@enderror
	        	</div>

	        	<div class="form-group">
    				<label for="email">Email</label>
	        		<span class="input-group-text p-0">
	            		<input type="email" class="form-control" data-bv-field="email" id="email" name="email" placeholder="Email" value="{{ $recipient && $recipient->email ? $recipient->email : old('email') }}" required {{ $recipient_exist ? 'readonly' : '' }}>
	        		</span>
	        		@error('email')
	        			<span class="text-danger">{{ $message }}</span>
        			@enderror
	        	</div>

	        	<div class="form-group">
    				<label for="address">Address</label>
	        		<span class="input-group-text p-0">
	            		<input type="text" class="form-control" data-bv-field="address" id="address" name="address" placeholder="Address" value="{{ $recipient && $recipient->address ? $recipient->address : old('address') }}" required {{ $recipient_exist ? 'readonly' : '' }}>
	        		</span>
	        		@error('address')
	        			<span class="text-danger">{{ $message }}</span>
        			@enderror
	        	</div>

	        	<div class="form-group">
    				<label for="city">City</label>
	        		<span class="input-group-text p-0">
	            		<input type="text" class="form-control" data-bv-field="city" id="city" name="city" placeholder="City" value="{{ $recipient && $recipient->city ? $recipient->city : old('city') }}" required {{ $recipient_exist ? 'readonly' : '' }}>
	        		</span>
	        		@error('name')
	        			<span class="text-danger">{{ $message }}</span>
        			@enderror
	        	</div>

	        	<div class="form-group">
    				<label for="selectReason">Select Reason...</label>
	        		<span class="input-group-text p-0">
	            		<select id="selectReason" name="reason_id" data-style="custom-select bg-transparent border-0" data-container="body" class="selectpicker form-control bg-transparent" required="">
	            			@foreach ($reasons as $reason)
		            			<option value="{{ $reason->id }}" {{ $recipient && $recipient->reason_id && $recipient->reason_id == $reason->id ? 'selected' : '' }}>{{ $reason->title }}</option>
	            			@endforeach
	        			</select>
	        		</span>
	        		@error('reason_id')
	        			<span class="text-danger">{{ $message }}</span>
        			@enderror
	        	</div>

	        	<div class="form-check custom-control custom-checkbox mb-3">
	        		<input id="agree" name="agree" class="custom-control-input" type="checkbox" value="1" required {{ $recipient_exist ? 'readonly' : '' }}>
	        		<label class="custom-control-label" for="agree">I have read and agree to the <a href="{{ route('frontend_terms') }}">Terms & Privacy</a> of QuickPeakup.com</label>
                </div>

	        	<button class="btn btn-primary btn-block">Continue</button>
          </div>
      	</form>
      </div>

	<div class="col-md-4 col-lg-6 col-xl-4 mx-auto">
		<div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
          <h3 class="text-5 font-weight-400 mb-3">Payment Details</h3>
          <div class="row">
            <div class="col-7">
                <small>You Send: </small>
            </div>
            <div class="col-5">
                <strong>AUD {{ number_format($data['send'], 2) }}</strong>
            </div>
            
            <hr>
            
            <div class="col-7">
                <small>Recipient Gets: </small>
            </div>
            <div class="col-5">
                <strong>BDT {{ number_format($data['receive'], 2) }}</strong>
            </div>
            
            <hr>
            
            <div class="col-7">
                <small>Service Fee: </small>
            </div>
            <div class="col-5">
                <strong>AUD {{ number_format($data['fee'], 2) }}</strong>
            </div>

            <hr>
            
            <div class="col-7">
                <small>Total with Fee: </small>
            </div>
            <div class="col-5">
                <strong>AUD {{ number_format($data['total_with_fee'], 2) }}</strong>
            </div>
        	</div>
		</div>
    </div>

  	</div>
  </div>
@stop