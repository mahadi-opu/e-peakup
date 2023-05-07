@extends('layouts.frontend')

@section('title', 'About Us')
	
@section('content')
	
<section class="page-header page-header-text-light py-0 mb-0">
  <section class="hero-wrap section">
    <div class="hero-mask opacity-7 bg-dark"></div>
    <div class="hero-bg hero-bg-scroll" style="background-image:url('./images/bg/image-2.jpg');"></div>
    <div class="hero-content">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <h1 class="text-11 font-weight-500 text-white mb-4">About Us</h1>
            <p class="text-5 text-white line-height-4 mb-4">Our mission is to help you save on transfer fees and exchange rates!</p>
            <a href="{{ route('register') }}" class="btn btn-primary m-2">Open a Free Account</a> <a class="btn btn-outline-light video-btn m-2" href="{{ route('frontend_how_it_works') }}"><span class="mr-2"></span>See How it Works</a> </div>
        </div>
      </div>
    </div>
  </section>
</section>

<div id="content">
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex">
          <div class="my-auto px-0 px-lg-5 mx-2">
            <h2 class="text-9">Who are we</h2>
              <p>QuickpeakUp Is a Mobile Wallet money transfer service on a mission to make the Mobile money transfer process quicker, safer, affordable, and more transparent. we're always offering the maximum Exchange rate with low service cost. QuickpeakUp is the fastest Mobile Wallet topUp and transfer Service in Australia.</p>
              
              <p>We are registered and regulated by the rules and regulations governed by Australia.
              We are only doing 24/7 service to easily send through Bkash, Nagad, Rocket, Upay  and also Mobile top up to Bangladesh in less than 5 minutes.</p>

              <p><strong>Our Mission:</strong> To create the easier transaction payments and top up from Australia to Bangladesh. And the most convenient, secure, cost-effective solution.</p>

              <p><strong>Our Vision:</strong> Every person has the right to participate fully in the global economy. We want to reach every person and expand globally.</p>

              <p><strong>Our Goal:</strong> Our goal is to implement our mission and vision.</p>

          </div>
        </div>
        <div class="col-lg-6 my-auto text-center">
          <img class="img-fluid shadow-lg rounded-lg" src="{{ asset('frontend/images/who-we-are.jpg') }}" alt="">
        </div>
      </div>
    </div>
  </section>
</div>

@stop