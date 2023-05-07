@extends('layouts/frontend')

@section('title', 'Profile')

@section('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop
  
@section('content')
  
  <div class="container py-4">
    <div class="row">
      @include('layouts/userpanel_sidebar')

      <div class="col-lg-9">

      	<div class="bg-light shadow-sm rounded p-4 mb-4">
            <h3 class="text-5 font-weight-400 mb-3">Personal Details <a href="#edit-personal-details" data-toggle="modal" class="float-right text-1 text-uppercase text-muted btn-link"><i class="fas fa-edit mr-1"></i>Edit</a></h3>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
              <p class="col-sm-9">{{ $user->name }}</p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Gender</p>
              <p class="col-sm-9">{{ $user->gender == 'm' ? 'Male' : 'Female' }}</p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Address</p>
              <p class="col-sm-9">{{ $user->address }}</p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Country</p>
              <p class="col-sm-9">{{ $user->country_name }}</p>
            </div>
          </div>

          <div class="bg-light shadow-sm rounded p-4 mb-4">
            <h3 class="text-5 font-weight-400 mb-3">Email Address</h3>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Email</p>
              <p class="col-sm-9">{{ $user->email }}</p>
            </div>
          </div>

          <div class="bg-light shadow-sm rounded p-4 mb-4">
            <h3 class="text-5 font-weight-400 mb-3">Phone</h3>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
              <p class="col-sm-9">+61{{ $user->phone }}</p>
            </div>
          </div>

          <div class="bg-light shadow-sm rounded p-4">
            <h3 class="text-5 font-weight-400 mb-3">Security <a href="#change-password" data-toggle="modal" class="float-right text-1 text-uppercase text-muted btn-link"><i class="fas fa-edit mr-1"></i>Edit</a></h3>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">
                <label class="col-form-label">Password</label>
              </p>
              <p class="col-sm-9">
                <input type="password" class="form-control-plaintext" data-bv-field="password" id="password" value="EnterPassword">
              </p>
            </div>
          </div>

      </div>

    </div>
  </div>

  <div id="edit-personal-details" class="modal fade " role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
           <div class="modal-header">
              <h5 class="modal-title font-weight-400">Personal Details</h5>
              <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
           </div>
           <div class="modal-body p-4">
              <form id="personaldetails" method="post" action="{{ route('userpanel_profile_update') }}" enctype="multipart/form-data">
                @csrf
                 <div class="row">
                  
                  <div class="col-4">
                     <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control dropify" data-bv-field="image" id="image" name="image" required placeholder="Image" @if($user->image) data-default-file="{{ asset($user->image) }}" @endif>
                     </div>
                  </div>

                  <div class="col-8">
                     <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" data-bv-field="name" id="name" name="name" required placeholder="Name" value="{{ $user->name }}">
                     </div>
                     <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" data-bv-field="email" id="email" name="email" required placeholder="Email" value="{{ $user->email }}">
                     </div>
                     <div class="form-group">
                        <label for="phone">Phone</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">+61</span>
                          </div>
                          <input type="tel" class="form-control" data-bv-field="phone" id="phone" name="phone" required placeholder="Phone" min="10" value="{{ $user->phone }}">
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="custom-select" id="gender" name="gender">
                           <option value disabled selected> --- Select Gender --- </option>
                           <option value="m" {{ $user->gender == 'm' ? 'selected' : '' }}>Male</option>
                           <option value="f" {{ $user->gender == 'f' ? 'selected' : '' }}>Female</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" data-bv-field="address" id="address" name="address" required placeholder="Address" value="{{ $user->address }}">
                     </div>
                     <div class="form-group">
                        <label for="inputCountry">Country</label>
                        <select class="custom-select" id="inputCountry" name="country_id" disabled="">
                           <option value="1" selected="">Australia</option>
                        </select>
                     </div>
                  </div>
                    
                 </div>
                 <button class="btn btn-primary btn-block mt-2" type="submit">Save Changes</button>
              </form>
           </div>
        </div>
     </div>
  </div>

  <div id="change-password" class="modal fade " role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
           <div class="modal-header">
              <h5 class="modal-title font-weight-400">Change Password</h5>
              <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
           </div>
           <div class="modal-body p-4">
              <form id="changePassword" method="post" action="{{ route('userpanel_profile_password_update') }}">
                @csrf
                 <div class="form-group">
                    <label for="existingPassword">Confirm Current Password</label>
                    <input type="text" class="form-control" data-bv-field="existingpassword" id="existingPassword" name="old_password" required placeholder="Enter Current Password">
                    @error('old_password')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                 </div>
                 <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <input type="text" class="form-control" data-bv-field="newpassword" id="newPassword" name="new_password" min="8" required placeholder="Enter New Password">
                    @error('new_password')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                 </div>
                 <div class="form-group">
                    <label for="confirmPassword">Confirm New Password</label>
                    <input type="text" class="form-control" data-bv-field="confirmgpassword" id="confirmPassword" name="new_password_confirmation" min="8" required placeholder="Enter Confirm New Password">
                    @error('new_password_confirmation')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                 </div>
                 <button class="btn btn-primary btn-block mt-4" type="submit">Update Password</button>
              </form>
           </div>
        </div>
     </div>
  </div>
  
@stop

@section('scripts')
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script type="text/javascript">
    $('.menu_profile').addClass('active');
    $('.userpanel_menu_profile').addClass('active');

    $('.dropify').dropify();
  </script>
@stop