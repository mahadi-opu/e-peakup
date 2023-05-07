@extends('layouts/frontend')

@section('title', 'Payment')

@section('styles')
	<style type="text/css">
		.global_payment_method {
			margin: 0 5px;
			padding-top: 10px;
			cursor: pointer;
			border: 2px solid #f5f5f5;
			border-radius: 5px;
		}
		.global_payment_method_border {
			border: 2px solid #4c4d4d;
		}
		.global_payment_image {
			width: 100px;
			height: 50px;
			object-fit: contain;
			cursor: pointer;
		}
		.payment_method_radio {
			display: none;
		}
		.input-group-text {
			background: none;
			border: none;
		}
	</style>

	<style type="text/css">
        .StripeElement {
            border: 1px solid rgba(0,0,0,.125);
            padding: 10px;
            border-radius: 5px;
        }
        input[name="stripeToken"] {
        	display: none;
        }
    </style>
@stop
	
@section('content')
	<div class="container">
		<h2 class="font-weight-400 text-center mt-3">Payment Method</h2>
		<div class="row">
			<div class="col-md-8 col-lg-6 col-xl-8 mx-auto bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
				<form action="{{ route('frontend_payment_store') }}" id="payment_form" method="post">
				    @csrf

				    <div class="form-group">
		        		<label>Payment Method</label>
		        		<span class="input-group-text p-0 mt-3">
		        			@foreach ($global_payments as $payment)
			        			<div class="global_payment_method {{ $loop->first ? 'global_payment_method_border' : '' }}">
				        			<input type="radio" id="payment{{ $loop->index }}" name="payment_method" class="payment_method_radio" value="{{ $payment->id }}">
				        			<label for="payment{{ $loop->index }}">
				        				<img src="{{ asset($payment->image) }}" class="global_payment_image">
				        			</label>
			        			</div>
		        			@endforeach
		        		</span>

		        		<div class="form-group m-1 mt-3 stripe_card d-none">
			        		<div id="card-element"></div>
	                        <div id="card-errors" role="alert"></div>
		        		</div>
		        	</div>

				    <div class="form-group">
				        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
				    </div>
				</form>
			</div>

			<div class="col-md-4 col-lg-6 col-xl-4 mx-auto bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
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
@stop

@section('scripts')
	<script type="text/javascript">
		$(document).on('change', '.global_payment_method', function() {
			$('.global_payment_method').removeClass('global_payment_method_border');
			$(this).addClass('global_payment_method_border');

			var payment_method = $('input[name="payment_method"]:checked').val();
			
			if (payment_method == 3 || payment_method == 4) {
				$('.stripe_card').slideDown(50, function(){
					$(this).removeClass('d-none');
				});
			} else {
				$('.stripe_card').slideUp(50, function(){
					$(this).addClass('d-none');
				});
			}
		});
	</script>

	<script src="https://js.stripe.com/v3/"></script>

    <script type="text/javascript">

        var stripe = Stripe('{{ env('STRIPE_TEST_PUBLISHABLE_KEY') }}');

        var elements = stripe.elements();

        var cardElement = elements.create('card', {
          style: {
            base: {
              iconColor: '#000',
              color: '#000',
              fontWeight: '500',
              fontFamily: 'Poppins, Arial, sans-serif',
              fontSize: '16px',
              fontSmoothing: 'antialiased',
            },
          },
        });

        cardElement.mount('#card-element');

        var form = document.getElementById('payment_form');
        form.addEventListener('submit', function(event) {
        	var payment_method = $('input[name="payment_method"]:checked').val();
        	if (payment_method == 3 || payment_method == 4) {
	            event.preventDefault();
	            stripe.createToken(cardElement).then(function(result) {
	                if (result.error) {
	                    // Inform the user if there was an error.
	                    var errorElement = document.getElementById('card-errors');
	                    errorElement.textContent = result.error.message;
	                } else {
	                    // Send the token to your server.
	                    stripeTokenHandler(result.token);
	                }
	            });
        	}
        });


        function stripeTokenHandler(token) {
            $('input[name=stripeToken]').remove();
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment_form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'text');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }


    </script>
@stop