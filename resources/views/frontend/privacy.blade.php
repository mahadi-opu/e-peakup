@extends('layouts.frontend')

@section('title', 'FAQ')
	
@section('content')
	
	<section class="section bg-white">
    <div class="container">
      <h2 class="text-9 text-center">FAQ</h2>
      <div class="row">
        <div class="col-md-10 mx-auto">
          <div class="row">

            <div class="col-md-6">
              <h3>For Mobile Top-Up</h3>
              <div class="accordion accordion-alternate" id="popularTopics">
                
                @foreach ($faqs_top_up as $faq)
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

            <div class="col-md-6">
              <h3>For Bkash/Rocket</h3>
              <div class="accordion accordion-alternate" id="popularTopics2">

                @foreach ($faqs_payment as $faq)
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

@stop