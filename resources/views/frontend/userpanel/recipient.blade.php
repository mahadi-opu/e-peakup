@extends('layouts/frontend')

@section('title', 'Recipients')

@section('styles')
@stop
  
@section('content')
  
  <div class="container py-4">
    <div class="row">
      @include('layouts/userpanel_sidebar')

      <div class="col-lg-9">
        
        <div class="bg-light shadow-sm rounded p-4 mb-4">
          <div class="row profile-completeness">
            
            <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
              <div class="border rounded p-3 text-center">
                <span class="d-block text-10 text-dark mt-2 mb-3">{{ $user->transaction }}</span>
                <p class="mb-0">Total Transaction</p>
              </div>
            </div>

            <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
              <div class="border rounded p-3 text-center">
                <span class="d-block text-10 text-dark mt-2 mb-3">{{ $user->transaction_amount }}</span>
                <p class="mb-0">Transaction Amount</p>
              </div>
            </div>

            <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
              <div class="border rounded p-3 text-center">
                <span class="d-block text-10 text-dark mt-2 mb-3">{{ $user->total_recipient }}</span>
                <p class="mb-0">Total Recipeint</p>
              </div>
            </div>

            <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
              <div class="border rounded p-3 text-center">
                <span class="d-block text-10 text-dark mt-2 mb-3">{{ $user->refers }}</span>
                <p class="mb-0">Total Refer</p>
              </div>
            </div>

          </div>
        </div>

        <div class="bg-light shadow-sm rounded pt-4">
          <h3 class="text-5 font-weight-400 align-items-center px-4 mb-3">List of Recipients</h3>
          
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Country</th>
                <th>#</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th colspan="10">{{ $recipients->links() }}</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($recipients as $recipient)
                <tr>
                  <td>{{ $loop->index+1 }}</td>
                  <td>{{ $recipient->name }}</td>
                  <td>{{ $recipient->email }}</td>
                  <td>{{ $recipient->number }}</td>
                  <td>Bangladesh</td>
                  <td><a href="{{ route('frontend_send', ['recipient_id' => $recipient->id]) }}" title="Send"><i class="fa fa-paper-plane"></i></a></td>
                </tr>
              @endforeach
            </tbody>  
          </table>

        </div>
      </div>
    </div>
  </div>
  
@stop

@section('scripts')

  <script type="text/javascript">
    $('.menu_profile').addClass('active');
    $('.userpanel_menu_recipients').addClass('active');

    $('.dropify').dropify();
  </script>
@stop