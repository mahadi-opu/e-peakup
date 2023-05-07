@extends('layouts/backend')

@section('title', 'Settings')
    
@section('styles')
	
@endsection

@section('content')
    
    <div class="md-card uk-margin-medium-bottom">
        <div class="user_heading uk-sticky-placeholder" data-uk-sticky="{ top: 48, media: 960 }">
            <div class="user_heading_content">
                <h2 class="heading_b">
                    <span>Settings</span>
                </h2>
            </div>
        </div>

        <div class="md-card-content">
            <form method="post" action="{{ route('admin_settings_update') }}">
                @csrf

                <h3 class="uk-text-center">Social Links</h3>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
                        <label for="facebook" class="uk-vertical-align-middle uk-text-bold">Facebook Profile Link:</label>
                    </div>
                    <div class="uk-width-medium-4-5">
                        <label for="facebook">Facebook Profile Link</label>
                        <input class="md-input" type="url" id="facebook" name="facebook" value="{{ $setting->facebook ?? '' }}">
                        @error('facebook')
                            <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
                        <label for="instagram" class="uk-vertical-align-middle uk-text-bold">Instagram Profile Link:</label>
                    </div>
                    <div class="uk-width-medium-4-5">
                        <label for="instagram">Instagram Profile Link</label>
                        <input class="md-input" type="url" id="instagram" name="instagram" value="{{ $setting->instagram ?? '' }}">
                        @error('instagram')
                            <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
                        <label for="youtube" class="uk-vertical-align-middle uk-text-bold">YouTube Profile Link:</label>
                    </div>
                    <div class="uk-width-medium-4-5">
                        <label for="youtube">YouTube Profile Link</label>
                        <input class="md-input" type="url" id="youtube" name="youtube" value="{{ $setting->youtube ?? '' }}">
                        @error('youtube')
                            <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
                        <label for="twitter" class="uk-vertical-align-middle uk-text-bold">Twitter Profile Link:</label>
                    </div>
                    <div class="uk-width-medium-4-5">
                        <label for="twitter">Twitter Profile Link</label>
                        <input class="md-input" type="url" id="twitter" name="twitter" value="{{ $setting->twitter ?? '' }}">
                        @error('twitter')
                            <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
                        <label for="linkedin" class="uk-vertical-align-middle uk-text-bold">Linkedin Profile Link:</label>
                    </div>
                    <div class="uk-width-medium-4-5">
                        <label for="linkedin">Linkedin Profile Link</label>
                        <input class="md-input" type="url" id="linkedin" name="linkedin" value="{{ $setting->linkedin ?? '' }}">
                        @error('linkedin')
                            <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <h3 class="uk-text-center">Youtube Video Links</h3>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
                        <label for="youtube_homepage" class="uk-vertical-align-middle uk-text-bold">Homepage YouTube Link:</label>
                    </div>
                    <div class="uk-width-medium-4-5">
                        <label for="youtube_homepage">Homepage YouTube Link</label>
                        <input class="md-input" type="url" id="youtube_homepage" name="youtube_homepage" value="{{ $setting->youtube_homepage ?? '' }}">
                        @error('youtube_homepage')
                            <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
                        <label for="youtube_about" class="uk-vertical-align-middle uk-text-bold">About Us YouTube Link:</label>
                    </div>
                    <div class="uk-width-medium-4-5">
                        <label for="youtube_about">About Us YouTube Link</label>
                        <input class="md-input" type="url" id="youtube_about" name="youtube_about" value="{{ $setting->youtube_about ?? '' }}">
                        @error('youtube_about')
                            <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
                        <label for="youtube_send_money" class="uk-vertical-align-middle uk-text-bold">Send Money YouTube Link:</label>
                    </div>
                    <div class="uk-width-medium-4-5">
                        <label for="youtube_send_money">Send Money YouTube Link</label>
                        <input class="md-input" type="url" id="youtube_send_money" name="youtube_send_money" value="{{ $setting->youtube_send_money ?? '' }}">
                        @error('youtube_send_money')
                            <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
                        @enderror
                    </div>
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

@endsection

@section('scripts')
	<script type="text/javascript">
		$('.sidebar_settings').addClass('current_section');
	</script>
@endsection