@if(session()->has('success'))
    <div class="uk-alert uk-alert-success" data-uk-alert>
        <a href="javascript:void(0)" class="uk-alert-close uk-close"></a>
        {{ session('success') }}
    </div>
@endif

@if(session()->has('danger'))
    <div class="uk-alert uk-alert-danger" data-uk-alert>
        <a href="javascript:void(0)" class="uk-alert-close uk-close"></a>
        {{ session('danger') }}
    </div>
@endif