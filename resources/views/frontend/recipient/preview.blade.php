@extends('layouts/frontend')

@section('title', 'Preview')

@section('content')
	<div class="container">
      <h2 class="font-weight-400 text-center mt-3">Preview Details</h2>
      <div class="row">

        <div class="col-md-8 col-lg-6 col-xl-8 mx-auto">
        	<div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
	          <h3 class="text-5 font-weight-400 mb-3">Payment Details</h3>
	          <div class="row">
	            <div class="col-7">
	                <small>Name: </small>
	            </div>
	            <div class="col-5">
	                <strong>{{ $recipient['name'] }}</strong>
	            </div>
	            
	            <hr>
	            
	            <div class="col-7">
	                <small>Phone: </small>
	            </div>
	            <div class="col-5">
	                <strong>{{ $recipient['number'] }}</strong>
	            </div>
	            
	            <hr>
	            
	            <div class="col-7">
	                <small>Email: </small>
	            </div>
	            <div class="col-5">
	                <strong>{{ $recipient['email'] }}</strong>
	            </div>

	            <hr>
	            
	            <div class="col-7">
	                <small>Address: </small>
	            </div>
	            <div class="col-5">
	                <strong>{{ $recipient['address'] }}, {{ $recipient['city'] }}</strong>
	            </div>
	        	</div>
	        </div>
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

	            @if($recipient['type'] && $recipient['type']['percentage'])
		            <div class="col-7">
		                <small>Additional Charge: </small>
		            </div>
		            <div class="col-5">
		                <strong> {{ $recipient['type']['percentage'] }}%</strong>
		            </div>
		            <hr>
	            @endif

	            <div class="col-7">
	                <small>Total to Pay: </small>
	            </div>
	            <div class="col-5">
	                <strong>AUD {{ number_format($data['grand_total'], 2) }}</strong>
	            </div>
	        	</div>
        	</div>
      	</div>

    </div>
    <form method="get" action="{{ route('frontend_payment_index') }}">
	    <button type="submit" class="btn btn-primary btn-block mb-3">Continue</button>
    </form>
@stop