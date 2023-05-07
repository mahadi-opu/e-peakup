<div class="uk-modal" id="changePasswordModal">

    <div class="user_heading uk-sticky-placeholder" data-uk-sticky="{ top: 48, media: 960 }">
        <div class="user_heading_content">
            <h2 class="heading_b uk-text-center"><span>Change Password</span></h2>
        </div>
    </div>

    <div class="uk-modal-dialog">
        <button type="button" class="uk-modal-close uk-close"></button>
        <form method="post" action="{{ route('admin_password_change') }}">
        @csrf

        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
                <label for="old_password" class="uk-vertical-align-middle uk-text-bold">Old Password:</label>
            </div>
            <div class="uk-width-medium-3-5">
                <label for="old_password">Type Old Password</label>
                <input class="md-input" type="text" id="old_password" name="old_password" value="{{ old('old_password') }}" required="">
                @error('old_password')
                    <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
                @endif
            </div>
        </div>

        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
                <label for="new_password" class="uk-vertical-align-middle uk-text-bold">New Password:</label>
            </div>
            <div class="uk-width-medium-3-5">
                <label for="new_password">Type New Password</label>
                <input class="md-input" type="text" id="new_password" name="new_password" value="{{ old('new_password') }}" required="">
                @error('new_password')
                    <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
                @endif
            </div>
        </div>

        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-2-5 uk-text-right">
            </div>
            <div class="uk-width-medium-3-5">
                <button type="submit" class="md-btn md-btn-primary">Submit</button>
            </div>
        </div>

    </form>
    </div>
</div>