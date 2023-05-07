@extends('layouts/frontend')

@section('title', 'Send Money')

@section('styles')
      
@stop

@section('content')

  <section class="hero-wrap section shadow-md py-4">
    <div class="hero-mask opacity-7 bg-dark"></div>
    <div class="hero-bg" style="background-image:url('{{ asset('frontend/images/bg/image-6.jpg') }}');"></div>
    <div class="hero-content py-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-xl-7 my-auto text-center text-lg-left pb-4 pb-lg-0">
            <h2 class="text-17 text-white"><span class="font-weight-400 text-15">A better way to</span> <br>
              Send Money</h2>
            <p class="text-4 text-white mb-4"> Send money with a better exchange rate and avoid excessive bank fees.</p>
            <a class="btn btn-outline-light video-btn" href="#" data-src="{{ $data->youtube_send_money }}" data-toggle="modal" data-target="#videoModal"><span class="text-2 mr-3"><i class="fas fa-play"></i></span>See How it Works</a> </div>
          
          <div class="col-lg-6 col-xl-5 my-auto">
            <div class="bg-white rounded shadow-md">
              <div class="text-center bg-primary text-white py-2 rounded">
                <span>Exchange Rate</span>
                <h2 class="text-7 text-center text-white">1 AUD = {{ $data->rate }} BDT</h2>
              </div>

              <div class="p-4">
                <form id="form-send-money" method="post" action="{{ route('frontend_send_post', ['recipient_exist' => $data->recipient_exist]) }}">
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
    </div>
  </section>
      
  <section class="section bg-white">
    <div class="container">
      <h2 class="text-9 text-center"> The simple way to send money</h2>
      <p class="text-4 text-center mb-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
      <div class="row">
        <div class="col-lg-4 mb-4">
          <div class="featured-box style-3">
            <div class="featured-box-icon text-light"><span class="w-100 text-20 font-weight-500">1</span></div>
            <h3>Sign Up Your Account</h3>
            <p class="text-3">Become a register user first, then log in to your account and enter your card or bank details that is required for you.</p>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="featured-box style-3">
            <div class="featured-box-icon text-light"><span class="w-100 text-20 font-weight-500">2</span></div>
            <h3>Select Your Recipient</h3>
            <p class="text-3">Enter your recipient's email address then add an amount with currency to send securely.</p>
          </div>
        </div>
        <div class="col-lg-4 mb-4 mb-sm-0">
          <div class="featured-box style-3">
            <div class="featured-box-icon text-light"><span class="w-100 text-20 font-weight-500">3</span></div>
            <h3>Send Money</h3>
            <p class="text-3">After sending money, the recipient will be notified via an email when money has been transferred to their account.</p>
          </div>
        </div>
      </div>
      <div class="text-center mt-2"><a href="#" class="btn btn-outline-primary shadow-none text-uppercase">Sign up Now</a></div>
    </div>
  </section>
      
  <section class="section">
    <div class="container">
      <h2 class="text-9 text-center">Why choose payyed?</h2>
      <p class="text-4 text-center mb-5">Here’s Top 4 reasons why using a Payyed account for manage your money.</p>
      <div class="row">
        <div class="col-md-6 mb-4 mb-md-0">
          <div class="hero-wrap section h-100 p-5 rounded">
            <div class="hero-mask rounded opacity-6 bg-dark"></div>
            <div class="hero-bg rounded" style="background-image:url('{{ asset('frontend/images/bg/image-6.jpg') }}');"></div>
            <div class="hero-content">
              <h2 class="text-6 text-white mb-3">Why Payyed?</h2>
              <p class="text-light mb-5">Lisque persius interesset his et, in quot quidam persequeris vim, ad mea essent possim iriure. Mutat tacimates id sit. Ridens mediocritatem ius an, eu nec magna imperdiet.</p>
              <h2 class="text-6 text-white mb-3">Send Money with Payyed</h2>
              <p class="text-light">Lisque persius interesset his et, in quot quidam persequeris vim, ad mea essent possim iriure. Mutat tacimates id sit. Ridens mediocritatem ius an, eu nec magna imperdiet.</p>
              <p class="text-light mb-0">Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="featured-box style-1">
            <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
            <h3>Over 180 countries</h3>
            <p>Essent lisque persius interesset his et, in quot quidam.</p>
          </div>
          <div class="featured-box style-1">
            <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
            <h3>Lower Fees</h3>
            <p>Lisque persius interesset his et, in quot quidam persequeris.</p>
          </div>
          <div class="featured-box style-1">
            <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
            <h3>Easy to Use</h3>
            <p>Essent lisque persius interesset his et, in quot quidam.</p>
          </div>
          <div class="featured-box style-1">
            <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
            <h3>Faster Payments</h3>
            <p>Quidam lisque persius interesset his et, in quot quidam.</p>
          </div>
          <div class="featured-box style-1">
            <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
            <h3>100% secure</h3>
            <p>Essent lisque persius interesset his et, in quot quidam.</p>
          </div>
          <div class="featured-box style-1">
            <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
            <h3>24/7 customer service</h3>
            <p>Quidam lisque persius interesset his et, in quot quidam.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <h2 class="text-9 text-center">What people say about Payyed</h2>
      <p class="text-4 text-center mb-4">A payments experience people love to talk about</p>
      <div class="row">
        <div class="col-lg-10 col-xl-8 mx-auto">
          <div class="owl-carousel owl-theme" data-autoplay="true" data-nav="true" data-loop="true" data-margin="30" data-stagepadding="5" data-items-xs="1" data-items-sm="1" data-items-md="1" data-items-lg="1">
            <div class="item">
              <div class="testimonial rounded text-center p-4">
                <p class="text-4">“Easy to use, reasonably priced simply dummy text of the printing and typesetting industry. Quidam lisque persius interesset his et, in quot quidam possim iriure.”</p>
                <strong class="d-block font-weight-500">Jay Shah</strong> <span class="text-muted">Founder at Icomatic Pvt Ltd</span> </div>
            </div>
            <div class="item">
              <div class="testimonial rounded text-center p-4">
                <p class="text-4">“I am happy Working with printing and typesetting industry. Quidam lisque persius interesset his et, in quot quidam persequeris essent possim iriure.”</p>
                <strong class="d-block font-weight-500">Patrick Cary</strong> <span class="text-muted">Freelancer from USA</span> </div>
            </div>
            <div class="item">
              <div class="testimonial rounded text-center p-4">
                <p class="text-4">“Fast easy to use transfers to a different currency. Much better value that the banks.”</p>
                <strong class="d-block font-weight-500">De Mortel</strong> <span class="text-muted">Online Retail</span> </div>
            </div>
            <div class="item">
              <div class="testimonial rounded text-center p-4">
                <p class="text-4">“I have used them twice now. Good rates, very efficient service and it denies high street banks an undeserved windfall. Excellent.”</p>
                <strong class="d-block font-weight-500">Chris Tom</strong> <span class="text-muted">User from UK</span> </div>
            </div>
            <div class="item">
              <div class="testimonial rounded text-center p-4">
                <p class="text-4">“It's a real good idea to manage your money by payyed. The rates are fair and you can carry out the transactions without worrying!”</p>
                <strong class="d-block font-weight-500">Mauri Lindberg</strong> <span class="text-muted">Freelancer from Australia</span> </div>
            </div>
            <div class="item">
              <div class="testimonial rounded text-center p-4">
                <p class="text-4">“Only trying it out since a few days. But up to now excellent. Seems to work flawlessly. I'm only using it for sending money to friends at the moment.”</p>
                <strong class="d-block font-weight-500">Dennis Jacques</strong> <span class="text-muted">User from USA</span> </div>
            </div>
          </div>
          <div class="text-center mt-4"><a href="#" class="btn-link text-4">See more people review<i class="fas fa-chevron-right text-2 ml-2"></i></a></div>
        </div>
      </div>
    </div>
  </section>

  <section class="section bg-white">
    <div class="container">
      <h2 class="text-9 text-center">Frequently Asked Questions</h2>
      <p class="text-4 text-center mb-4 mb-sm-5">Can't find it here? Check out our <a href="help.html">Help center</a></p>
      <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">
          <hr class="mb-0">
          <div class="accordion accordion-alternate arrow-right" id="popularTopics">
            <div class="card">
              <div class="card-header" id="heading1">
                <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">What is Payyed?</a> </h5>
              </div>
              <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#popularTopics">
                <div class="card-body"> Lisque persius interesset his et, in quot quidam persequeris vim, ad mea essent possim iriure. Mutat tacimates id sit. Ridens mediocritatem ius an, eu nec magna imperdiet. </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="heading2">
                <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">How to send money online?</a> </h5>
              </div>
              <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#popularTopics">
                <div class="card-body"> Iisque Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="heading3">
                <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">Is my money safe with Payyed?</a> </h5>
              </div>
              <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#popularTopics">
                <div class="card-body"> Iisque persius interesset his et, in quot quidam persequeris vim, ad mea essent possim iriure. Mutat tacimates id sit. Ridens mediocritatem ius an, eu nec magna imperdiet. </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="heading4">
                <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">How much fees does Payyed charge?</a> </h5>
              </div>
              <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#popularTopics">
                <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="heading5">
                <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">What is the fastest way to send money abroad?</a> </h5>
              </div>
              <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#popularTopics">
                <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="heading6">
                <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">Can I open an Payyed account for business?</a> </h5>
              </div>
              <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#popularTopics">
                <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. </div>
              </div>
            </div>
          </div>
          <hr class="mt-0">
        </div>
      </div>
      <div class="text-center mt-4"><a href="{{ route('frontend_help') }}" class="btn-link text-4">See more FAQ<i class="fas fa-chevron-right text-2 ml-2"></i></a></div>
    </div>
  </section>

  <section class="hero-wrap py-5">
    <div class="hero-mask opacity-8 bg-dark"></div>
    <div class="hero-bg" style="background-image:url('{{ asset('frontend/images/bg/image-2.jpg') }}');"></div>
    <div class="hero-content">
      <div class="container d-md-flex text-center text-md-left align-items-center justify-content-center">
        <h2 class="text-6 font-weight-400 text-white mb-3 mb-md-0">Sign up today and get your first transaction fee free!</h2>
        <a href="{{ route('register') }}" class="btn btn-outline-light text-nowrap ml-4">Sign up Now</a> </div>
    </div>
  </section>

@stop

@section('scripts')
  
  <script type="text/javascript">
    $('.menu_send_money').addClass('active');
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