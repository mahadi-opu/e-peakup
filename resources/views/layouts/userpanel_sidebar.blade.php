@php
  $user = App\Models\User::findOrFail(auth()->user()->id);
@endphp

<aside class="col-lg-3">
	      
  <div class="bg-light shadow-sm rounded text-center p-3 mb-4">
    <div class="profile-thumb mt-3 mb-4">
      <img class="rounded-circle w-100" src="{{ asset($user->image ?? 'backend/assets/img/default-avatar.png') }}" alt="">
      <div class="profile-thumb-edit custom-file bg-primary text-white" data-toggle="tooltip" title="Change Profile Picture"> <i class="fas fa-camera position-absolute"></i>
        <form id="profileThumbForm" method="post" action="{{ route('userpanel_profile_thumb') }}" enctype="multipart/form-data">
          @csrf
          <input type="file" class="custom-file-input profile_thumb" id="customFile" name="image">
        </form>
      </div>
    </div>
    <p class="text-3 font-weight-500 mb-2"><a href="{{ route('userpanel_profile_index') }}" class="text-dark">{{ $user->name }}</a></p>
  </div>

  <div class="bg-light shadow-sm rounded p-3 mb-4">
    @include('layouts/userpanel_menu')
  </div>

  <div class="bg-light shadow-sm rounded p-3 mb-4">
    <p>Refer Friends</p>
    <input type="url" class="form-control" id="link_to_copy" value="{{ route('register', ['refer' => $user->id]) }}" readonly="">
    <button type="button" onclick="copyToClipboard()" class="btn btn-primary btn-sm btn-block mt-1">Copy to clipboard</button>
  </div>

  <div class="bg-light shadow-sm rounded text-center p-3 mb-4">
    <div class="text-17 text-light my-3"><i class="fas fa-wallet"></i></div>
    <h3 class="text-9 font-weight-400">{{ $user->free_transaction }}</h3>
    <p class="mb-2 text-muted opacity-8">Free Transcation</p>
  </div>
  
</aside>