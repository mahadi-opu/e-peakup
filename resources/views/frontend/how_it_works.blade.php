@extends('layouts.frontend')

@section('title', 'How It Works')
	
@section('content')
  
  <section class="section bg-white">
    <div class="container">
      <div class="row">
        <div class="col-xl-10 mx-auto">
          <h2 class="text-9 text-center"> The simple way to Send Money</h2>
          <div class="row mt-5">
            <div class="col-md-5 col-lg-6 text-center order-2 order-md-1">
              <img class="img-fluid shadow" src="{{ asset('frontend/images/send_money.jpg') }}" alt="">
            </div>
            <div class="col-md-7 col-lg-6 order-1 order-md-2">
              <div class="row">
                <div class="col-12 mb-4">
                  <div class="featured-box style-3">
                    <div class="featured-box-icon text-light"><span class="w-100 text-20 font-weight-500">1</span></div>
                    <h3>Step 1: Fill up your payment & other details.</h3>
                    <p>Click the link <a href="https://quickpeakup.com/register"><strong>https://quickpeakup.com/register.</strong></a> Please fill up your details with your correct mobile number with country code, contacts in Bangladesh, total amount of payment to transfer, e-mail address and personal information. Please click “Send” button after filling all details.</p>
                  </div>
                </div>
                <div class="col-12 mb-4">
                  <div class="featured-box style-3">
                    <div class="featured-box-icon text-light"><span class="w-100 text-20 font-weight-500">2</span></div>
                    <h3>Step 2: Check all details and click “Pay Now” button.</h3>
                    <p>At this step, please check all the information you have provided us in previous step. Please double check your contact number, bank details and contact number in Bangladesh. We may send you six digits OTP in your mobile number or e-mail address. After your confirmation of OTP we are sending your bkash/Rocket or any operator mobile Top-up in Bangladesh. <br> Please click “Pay Now” button after double checking all details.</p>
                  </div>
                </div>
                <div class="col-12 mb-4 mb-sm-0">
                  <div class="featured-box style-3">
                    <div class="featured-box-icon text-light"><span class="w-100 text-20 font-weight-500">3</span></div>
                    <h3>Sign in Poli or Paypal for Pay & use your credit, debit card or bank account</h3>
                    <p> If you have a Poli/ Paypal account, please sign in and pay the amount and wait 10 seconds to return to our site to get the confirmation. You can also pay by use your credit or debit card. Please fill up all information including your VISA, AMEX, and MASTERCARD. And complete the process.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section bg-white">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 order-2 order-lg-1">
          <div class="hero-wrap section h-100 p-5 mx-4 rounded-pill">
            <div class="hero-mask rounded-pill opacity-7 bg-dark"></div>
            <div class="hero-bg rounded-pill" style="background-image:url('{{ asset('frontend/images/bg/image-6.jpg') }}');"></div>
            <div class="hero-content text-center py-5 my-5"> <a class="video-btn d-inline-flex" href="#" data-src="https://www.youtube.com/embed/7e90gBu4pas" data-toggle="modal" data-target="#videoModal"> <span class="btn-video-play bg-white shadow-md rounded-circle m-auto"><i class="fas fa-play"></i></span> </a> </div>
          </div>
        </div>
        <div class="col-lg-5 my-auto order-1 order-lg-2">
          <h2 class="text-9">How does it work?</h2>
        </div>
      </div>
    </div>
  </section>
@stop