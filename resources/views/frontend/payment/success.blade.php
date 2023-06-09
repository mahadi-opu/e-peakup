@extends('layouts/frontend')

@section('title', 'Success')
	
@section('content')
	<div class="container">
      <h2 class="font-weight-400 text-center mt-3 mb-4">Send Money</h2>
      <div class="row">
        <div class="col-md-8 col-lg-6 col-xl-5 mx-auto"> 
          <!-- Request Money Success
          ============================================= -->
          <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
            <div class="text-center my-5">
              <p class="text-center text-success text-20 line-height-07"><i class="fas fa-check-circle"></i></p>
              <p class="text-center text-success text-8 line-height-07">Success!</p>
              <p class="text-center text-4">Transactions Complete</p>
            </div>
            <a href="{{ route('frontend_send') }}" class="btn btn-primary btn-block">Request Money Again</a>
          </div>
          <!-- Request Money Success end --> 
        </div>
      </div>
    </div>
@stop