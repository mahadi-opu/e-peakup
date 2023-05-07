@extends('layouts.backend')

@section('title', 'Profile')
	
@section('content')
	<div class="md-card uk-margin-medium-bottom">

		<div class="user_heading uk-sticky-placeholder" data-uk-sticky="{ top: 48, media: 960 }">
            <div class="user_heading_content">
                <h2 class="heading_b">
                    <span>Profile</span>
                </h2>
            </div>
        </div>

		<div class="md-card-content">
            <form method="post" action="{{ route('admin_profile_update') }}" enctype="multipart/form-data">
                @csrf
    			<div class="uk-grid">
                    <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
                        <label for="name" class="uk-vertical-align-middle uk-text-bold">Name:</label>
                    </div>
                    <div class="uk-width-medium-1-5">
                        <input class="dropify" type="file" id="image" name="image" @if(auth()->user()->image) data-default-file="{{ asset(auth()->user()->image) }}" @endif required="">
                        @error('image')
                            <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="uk-grid">
                    <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
                        <label for="name" class="uk-vertical-align-middle uk-text-bold">Name:</label>
                    </div>
                    <div class="uk-width-medium-4-5">{{ $user->name }}</div>
                </div>

                <div class="uk-grid">
                    <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
                        <label for="email" class="uk-vertical-align-middle uk-text-bold">Email:</label>
                    </div>
                    <div class="uk-width-medium-4-5">{{ $user->email }}</div>
                </div>

                <div class="uk-grid">
                    <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
                        <label for="phone" class="uk-vertical-align-middle uk-text-bold">Phone:</label>
                    </div>
                    <div class="uk-width-medium-4-5">{{ $user->phone }}</div>
                </div>

                <div class="uk-grid">
                    <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
                        <label for="role" class="uk-vertical-align-middle uk-text-bold">Role:</label>
                    </div>
                    <div class="uk-width-medium-4-5">{{ $user->role->name }}</div>
                </div>

                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-5 uk-text-right">
                    </div>
                    <div class="uk-width-medium-4-5">
                        <button type="submit" class="md-btn md-btn-primary">Submit</button>
                    </div>
                </div>

            </form>

		</div>
	</div>
@stop