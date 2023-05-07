@extends('layouts/frontend')

@section('title', env('APP_NAME', 'QuickPickup'))

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/owl.carousel/assets/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

	<style type="text/css">
		.send_money_content {
			position: absolute !important;
			top: 6%;
			right: 100px;
		}
		.fluid_content {
			padding: 0 4rem;
		}
		.carousel-item:after {
		  content:"";
		  display:block;
		  position:absolute;
		  top:0;
		  bottom:0;
		  left:0;
		  right:0;
		  background:rgba(0,0,0,0.4);
		}
		.animate-bottom {
		  position: relative;
		  animation: animatebottom 0.4s;
		}

		.offer-news {
		    width: 160px
		}

		.offer-news-scroll a {
		    text-decoration: none
		}

		.dot {
		    height: 6px;
		    width: 6px;
		    margin-left: 3px;
		    margin-right: 3px;
		    margin-top: 2px !important;
		    background-color: rgb(207, 23, 23);
		    border-radius: 50%;
		    display: inline-block
		}

		.main_slider_carousel_inner, .main_slider_carousel_image {
			height: 700px;
		}

		@keyframes animatebottom {
		  from {
		    bottom: -300px;
		    opacity: 0;
		  }

		  to {
		    bottom: 0;
		    opacity: 1;
		  }
		}

		@media only screen and (max-width: 600px){
			.fluid_content {
				padding: 0;
			}
			.send_money_content {
				right: 0;
				position: relative !important;
			}
			.main_slider_carousel_inner, .main_slider_carousel_image {
				height: 200px;
			}
		}

	</style>
@stop

@section('content')

@if ($offer)
	<div class="container-fluid">
	    <div class="row">
	        <div class="col-md-12">
	            <div class="d-flex justify-content-between align-items-center breaking-news bg-primary">
                <div class="d-flex flex-row flex-grow-1 flex-fill justify-content-center bg-danger py-2 text-white px-1 offer-news"><span class="d-flex align-items-center">&nbsp;Exclusive Offer</span></div>
                <marquee class="offer-news-scroll" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                	<span class="dot"></span>
                	<a href="#" class="text-white">{{ $offer->text }}</a>
                </marquee>
	            </div>
	        </div>
	    </div>
	</div>
@endif

<section class="hero-wrap shadow-md">

	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="50000">
		<ol class="carousel-indicators">
			@foreach ($sliders as $slider)
	    	<li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
	    @endforeach
	  </ol>
	  <div class="carousel-inner main_slider_carousel_inner">
	    @foreach ($sliders as $slider)
				<div class="carousel-item {{ $loop->first ? 'active' : '' }}">
					<img class="d-block w-100 main_slider_carousel_image" src="{{ asset($slider->notice) }}">
				</div>
			@endforeach
	  </div>
	</div>

	<div class="send_money_content hero-content py-5">
		<div class="container-fluid">
		  <div class="my-auto fluid_content">

				<div class="bg-white rounded shadow-md">
          <div class="text-center bg-primary text-white py-2 rounded">
            <span>Exchange Rate</span>
            <h2 class="text-7 text-center text-white animate__animated animate__infinite animate__heartBeat animate__delay-2s">1 AUD = {{ $data->rate }} BDT</h2>
          </div>

          <div class="p-4">
            <form id="form-send-money" method="post" action="{{ route('frontend_send_post', ['recipient_exist' => false]) }}">
              @csrf
              <div class="form-group">
                <label for="youSend">You Send</label>
                <div class="input-group">
                  <div class="input-group-prepend"> <span class="input-group-text">$</span> </div>
                  <input type="text" class="form-control" data-bv-field="youSend" id="youSend" name="send" min="0" value="{{ $data->send ?? 1 }}" placeholder="AUD..." required>
                  <div class="input-group-append">
                    <span class="input-group-text p-0">
                      <select id="youSendCurrency" data-style="custom-select bg-transparent border-0" data-container="body" class="selectpicker form-control bg-transparent" required="">
                          <option data-icon="currency-flag currency-flag-aud mr-1" data-subtext="Australian dollar" value="aud" selected>AUD</option>
                      </select>
                    </span>
                  </div>
                </div>
                @error('send')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="recipientGets">Recipient Gets</label>
                <div class="input-group">
                  <div class="input-group-prepend"> <span class="input-group-text">৳</span> </div>
                  <input type="text" class="form-control" data-bv-field="recipientGets" id="recipientGets" value="{{ $data->receive ?? $data->rate }}" placeholder="BDT...">
                  <div class="input-group-append">
                    <span class="input-group-text p-0">
                      <select id="recipientCurrency" data-style="custom-select bg-transparent border-0" data-container="body" class="selectpicker form-control bg-transparent" required="">
                        <option data-icon="currency-flag currency-flag-bdt mr-1" data-subtext="Bangladeshi taka" value="bdt">BDT</option>
                      </select>
                    </span>
                  </div>
                </div>
              </div>

              <p class="text-muted">The current exchange rate is <span class="font-weight-500">1 AUD = {{ $data->rate }} BDT</span></p>

              <div class="form-group">
                <label for="recipientGets">Select Service</label>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <span class="input-group-text p-0">
                      <select id="selectService" name="service_id" data-style="custom-select bg-transparent border-0" data-container="body" class="form-control bg-transparent" required="">
                        <option disabled selected>Select...</option>
                        @foreach ($services as $service)
                          <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                        @endforeach
                      </select>
                    </span>
                    @error('service_id')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <span class="input-group-text p-0">
                      <select id="selectOperator" name="payment_method_id" data-style="custom-select bg-transparent border-0" data-container="body" class="form-control bg-transparent" required="">
                        
                      </select>
                    </span>
                    @error('payment_method_id')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <p class="total_fee text-muted mb-1 d-none">Total fees - <span class="font-weight-500 total_fee_text"></span></p>
                <p class="total_with_fee text-muted mb-1 d-none">Total amount including fees - <span class="font-weight-500 total_with_fee_text"></span></p>

              </div>

              <button type="submit" class="btn btn-primary btn-block">Continue</button>
            </form>
          </div>

        </div>

			</div>
		</div>
	</div>
</section>

{{-- @if ($offer)
	<div class="container mt-5">
	    <div class="row">
	        <div class="col-md-12">
	            <div class="d-flex justify-content-between align-items-center breaking-news bg-primary">
                <div class="d-flex flex-row flex-grow-1 flex-fill justify-content-center bg-danger py-2 text-white px-1 offer-news"><span class="d-flex align-items-center">&nbsp;Exclusive Offer</span></div>
                <marquee class="offer-news-scroll" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                	<span class="dot"></span>
                	<a href="#" class="text-white">{{ $offer->text }}</a>
                </marquee>
	            </div>
	        </div>
	    </div>
	</div>
@endif --}}

<!-- Why choose us ============================================= -->
<section class="section">
  <div class="container">
	 <h2 class="text-9 text-center text-uppercase font-weight-400">Why choose us?</h2>
	 <p class="text-4 text-center font-weight-300 mb-5">Here’s Top 4 reasons why using a Quick Peakup account to manage your money.</p>
	 <div class="row">
		<div class="col-lg-10 mx-auto">
		  <div class="row">
			 <div class="col-sm-6 mb-4">
				<div class="featured-box style-3">
				  <div class="featured-box-icon border border-primary text-primary rounded-circle">
					 <i class="fas fa-hand-pointer"></i>
				  </div>
				  <h3 class="font-weight-400">Easy to use</h3>
				  <p>It’s a very simple and easiest way to use. Its simplicity makes it easier.</p>
				</div>
			 </div>
			 <div class="col-sm-6 mb-4">
				<div class="featured-box style-3">
				  <div class="featured-box-icon border border-primary text-primary rounded-circle">
					 <i class="fas fa-share"></i>
				  </div>
				  <h3 class="font-weight-400">Faster Payments</h3>
				  <p>After signing up you make payment faster without any obstacle within a few steps. </p>
				</div>
			 </div>
			 <div class="col-sm-6 mb-4 mb-sm-0">
				<div class="featured-box style-3">
				  <div class="featured-box-icon border border-primary text-primary rounded-circle">
					 <i class="fas fa-dollar-sign"></i>
				  </div>
				  <h3 class="font-weight-400">Lower Fees</h3>
				  <p>We are committed to giving you the minimum fees and Maximum exchange rate on every transaction.</p>
				</div>
			 </div>
			 <div class="col-sm-6">
				<div class="featured-box style-3">
				  <div class="featured-box-icon border border-primary text-primary rounded-circle">
					 <i class="fas fa-lock"></i>
				  </div>
				  <h3 class="font-weight-400">100% secure</h3>
				  <p>Quick Peakup is one of the safest systems to send Bkash, Nagad, Rocket, uPay and Mobile top up for Grameenphone, Banglalink, Airtel, Taletalk,Robi.</p>
				</div>
			 </div>
		  </div>
		</div>
	 </div>
  </div>
</section>
<!-- Why choose us End -->

<section class="section py-5">
   <div class="container text-center">
   	<h2 class="text-9 text-center text-uppercase font-weight-400">Pay With</h2>

		<div class="owl-carousel owl-theme" data-autoplay="true" data-nav="true" data-loop="true" data-margin="30" data-slideby="2" data-stagepadding="5" data-items-xs="2" data-items-sm="3" data-items-md="4" data-items-lg="6">
	 		@foreach ($payment_methods as $method)
	      <div class="item">
	      	<div class="featured-box style-5 rounded">
						<div class="featured-box-icon text-primary">
							<img src="{{ asset($method->image) }}" style="width: 130px; height: 50px; margin: auto; object-fit: contain;">
						</div>
					</div>
	      </div>
      @endforeach
		</div>
</section>

<section class="section bg-white">
  <div class="container">
  	<h2 class="text-9 mb-4 text-center">About Us</h2>
    <div class="row no-gutters">
      <div class="col-lg-6 d-flex order-1 order-lg-2">
        <div class="my-auto px-0 px-lg-5">
          <h4 class="text-4 font-weight-500">Our Mission</h4>
          <p class="tex-3" >QuickPeakup.com is Registered and regulated by the rules and regulations governed by Australia.</p>
          <h4 class="text-4 font-weight-500 mb-2">Our Vision</h4>
          <p class="tex-3" >Our company is managed by people who have extensive experience in bkash/ Rocket / Nagad & Mobile Top-Up, consumer payments processing and data security.</p>
          <h4 class="text-4 font-weight-500 mb-2">Our Goal</h4>
          <p class="tex-3" >We understand how important each and every payment service is to our customers and are committed to earning your business. With in short time anyone can bkash/ Rocket/ Nagad/ Mobile Top-up to Bangladesh.</p>
        </div>
      </div>
      <div class="col-lg-6">
        <ul class="list-group">
            <li class="list-group-item">Free Registration from any part of the world</li>
            <li class="list-group-item">Easy payment option</li>
            <li class="list-group-item">Safe - Secure – Reliable</li>
            <li class="list-group-item">Free Sign up</li>
            <li class="list-group-item">For Bkash/Rocket fees will be charged $5.00 AUD</li>
            <li class="list-group-item">For Top Up fees will be charged $3.00 AUD</li>
            <li class="list-group-item">For Nagad fees will be charged $5.00 AUD</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- How it works ============================================= -->
<section class="section">
  <div class="container">
	 <h2 class="text-9 text-center text-uppercase font-weight-400">As simple as 1-2-3</h2>
	 <div class="row">
		<div class="col-sm-4 mb-4">
		  <div class="featured-box style-4">
			 <div class="featured-box-icon text-dark shadow-none border-bottom">
				<span class="w-100 text-20 font-weight-500">1</span>
			 </div>
			 <h3 class="mb-3">Sign Up Your Account</h3>
			 <p class="text-3 font-weight-300">Sign up for your account in few a minutes.</p>
		  </div>
		</div>
		<div class="col-sm-4 mb-4 mb-sm-0">
		  <div class="featured-box style-4">
			 <div class="featured-box-icon text-dark shadow-none border-bottom">
				<span class="w-100 text-20 font-weight-500">2</span>
			 </div>
			 <h3 class="mb-3">Add Recipient</h3>
			 <p class="text-3 font-weight-300">Add your receipent whom you send your money.</p>
		  </div>
		</div>
		<div class="col-sm-4 mb-4">
		  <div class="featured-box style-4">
			 <div class="featured-box-icon text-dark shadow-none border-bottom">
				<span class="w-100 text-20 font-weight-500">2</span>
			 </div>
			 <h3 class="mb-3">Send Money</h3>
			 <p class="text-3 font-weight-300">Send Your Money to Bangladesh.</p>
		  </div>
		</div>
	 </div>
	 <div class="text-center mt-2">
		<a href="{{ route('register') }}" class="btn btn-primary">Open a Free Account</a>
	 </div>
  </div>
</section>
<!-- How it works End -->

<!-- What can you do ============================================= -->
<section class="section bg-white">
  <div class="container">
	 <h2 class="text-9 text-center text-uppercase font-weight-400">We are available for</h2>
	 <div class="row">

	 	<div class="owl-carousel owl-theme" data-autoplay="true" data-nav="true" data-loop="true" data-margin="30" data-slideby="2" data-stagepadding="5" data-items-xs="2" data-items-sm="3" data-items-md="4" data-items-lg="6">
	 		@foreach ($operators as $operator)
      <div class="item">
      	<div class="featured-box style-5 rounded">
					<div class="featured-box-icon text-primary">
						<img src="{{ asset($operator->image) }}" style="width: 60px; height: 60px; margin: auto; object-fit: contain;">
					</div>
					<h3>{{ $operator->name }}</h3>
				</div>
      </div>
      @endforeach
    </div>

	 </div>
  </div>
</section>
<!-- What can you do End -->

<!-- Testimonial ============================================= -->

<section class="hero-wrap section shadow-md">
  <div class="hero-mask opacity-3 bg-dark"></div>
  <div class="hero-bg hero-bg-scrll" style="background-image:url('{{ asset('frontend/images/bg/image-4.jpg') }}');"></div>
  <div class="hero-content py-0 py-lg-5 my-0 my-lg-5">
    <div class="container text-center">
      <h2 class="text-9 text-white font-weight-400 text-uppercase mb-5">What our customers say</h2>
      <a class="video-btn d-flex" href="#" data-src="{{ $data->youtube_homepage }}" data-toggle="modal" data-target="#videoModal"> <span class="btn-video-play bg-white shadow-md rounded-circle m-auto"><i class="fas fa-play"></i></span> </a> </div>
  </div>
</section>
<!-- Testimonial end -->

<section class="section py-5" id="contactUs">
	<h3 class="text-center pb-3">Contact Us</h3>
	<div class="container">
		<form id="personaldetails" method="post" action="{{ route('frontend_issue_store') }}">
			@csrf
	    <div class="row">
	      <div class="col-12 col-sm-6">
	        <div class="form-group">
	          <label for="name">Name</label>
	          <input type="text" class="form-control" data-bv-field="name" id="name" name="name" required placeholder="Name">
	        </div>
	      </div>
	      <div class="col-12 col-sm-6">
	        <div class="form-group">
	          <label for="email">Email</label>
	          <input type="email" class="form-control" data-bv-field="email" id="email" name="email" required placeholder="Email">
	        </div>
	      </div>
	      <div class="col-12">
	        <div class="form-group">
	          <label for="subject">Subject</label>
	          <input type="subject" class="form-control" data-bv-field="subject" id="subject" name="subject" required placeholder="Subject">
	        </div>
	      </div>
	      <div class="col-12">
	        <div class="form-group">
	          <label for="message">Message</label>
	          <textarea class="form-control" name="message" placeholder="Message" required=""></textarea>
	        </div>
	      </div>

	      <div class="col-12">
		      <button class="btn btn-primary btn-block mt-2" type="submit">Save Changes</button>
		    </div>
	    </div>
	  </form>
	</div>
</section>

@stop

@section('scripts')

<script src="{{ asset('frontend/vendor/owl.carousel/owl.carousel.min.js') }}"></script>

<script type="text/javascript">
	var cookies_show = localStorage.getItem('cookies');

	if (!cookies_show) {
		$(document).ready(function() {
			setTimeout(function(){
				$('#cookiesModal').modal('show');
			}, 2000);
		});
	}

	$(document).on('click', '.cookies_modal_button', function() {
		localStorage.setItem('cookies', true);
	});
</script>

<script type="text/javascript">
    $(document).on('keyup', '#youSend', function() {
      var send = Number($(this).val());
      var rate = '{{ $data->rate ?? 0 }}';
      var fee = '{{ $fee ?? 0 }}';
      var receive = Number((send * rate) + (fee * rate)).toFixed(2);
      $('#recipientGets').val(receive);
      calculateTotal();
    });

    $(document).on('keyup', '#recipientGets', function() {
      var rate = '{{ $data->rate ?? 0 }}';
      var receive = $(this).val();
      var send = Number(receive / rate).toFixed(2);
      $('#youSend').val(send);
      calculateTotal();
    });

    function calculateTotal() {
    	$('#selectOperator').html('');
      var fee = '{{ $fee ?? 0 }}';
      var amount_without_fee = parseFloat($('#youSend').val().replace(',', ''));
      var service_id = $('#selectService').val();
      var html = '';

      if (service_id) {
        $.ajax({
          url: '{{ route('frontend_api_payment_methods') }}',
          type: 'GET',
          data: {
            service_id: service_id
          },
        })
        .done(function(response) {
          $('.total_fee').removeClass('d-none');
          $('.total_with_fee').removeClass('d-none');
          $('.total_fee_text').text(response.service.charge+' AUD');
          var total_with_fee_text = Number(amount_without_fee) + Number(response.service.charge);
          $('.total_with_fee_text').text(total_with_fee_text.toFixed(2) + ' AUD');
          
          $.each(response.payment_methods, function(index, payment_method) {
            html += '<option value="'+payment_method.id+'">'+payment_method.name+'</option>';
          });
          
          $('#selectOperator').html(html);
        })
        .fail(function() {
          console.log("error");
        });
      }
    }

    $(document).on('change', '#selectService', function() {
      calculateTotal();
    });
  </script>

@stop