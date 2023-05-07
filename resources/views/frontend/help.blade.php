@extends('layouts.frontend')

@section('title', 'FAQ')
	
@section('content')
	
	<section class="section bg-white">
    <div class="container">
      <h2 class="text-9 text-center">FAQ</h2>
      <div class="row">
        <div class="col-md-10 mx-auto">
          <div class="row">

            <div class="col-md-12">
              <div class="accordion accordion-alternate" id="popularTopics">
                
                @foreach ($faqs as $faq)
                  <div class="card">
                    <div class="card-header" id="heading{{ $faq->id }}">
                      <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">{{ $faq->question }}</a> </h5>
                    </div>
                    <div id="collapse{{ $faq->id }}" class="collapse" aria-labelledby="heading{{ $faq->id }}" data-parent="#popularTopics">
                      <div class="card-body">{{ $faq->answer }}</div>
                    </div>
                  </div>
                @endforeach

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section py-4 my-4 py-sm-5 my-sm-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="bg-white shadow-sm rounded pl-4 pl-sm-0 pr-4 py-4">
            <div class="row no-gutters">
              <div class="col-12 col-sm-auto text-13 text-light d-flex align-items-center justify-content-center"> <span class="px-4 ml-3 mr-2 mb-4 mb-sm-0"><i class="far fa-envelope"></i></span> </div>
              <div class="col text-center text-sm-left">
                <div class="">
                  <h5 class="text-3 text-body">Can't find what you're looking for?</h5>
                  <p class="text-muted mb-0">We want to answer all of your queries. Get in touch and we'll get back to you as soon as we can. <a class="btn-link" href="{{ url('/') }}/#contactUs">Contact us<span class="text-1 ml-1"><i class="fas fa-chevron-right"></i></span></a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mt-4 mt-lg-0">
          <div class="bg-white shadow-sm rounded pl-4 pl-sm-0 pr-4 py-4">
            <div class="row no-gutters">
              <div class="col-12 col-sm-auto text-13 text-light d-flex align-items-center justify-content-center"> <span class="px-4 ml-3 mr-2 mb-4 mb-sm-0"><i class="far fa-comment-alt"></i></span> </div>
              <div class="col text-center text-sm-left">
                <div class="">
                  <h5 class="text-3 text-body">Technical questions</h5>
                  <p class="text-muted mb-0">Have some technical questions? Hit us up on live chat or whatever. <a class="btn-link" href="">Click here<span class="text-1 ml-1"><i class="fas fa-chevron-right"></i></span></a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@stop