@extends('layouts/backend')

@section('title', 'Dashboard')

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/bower_components/chartist/dist/chartist.min.css') }}">
@stop
	
@section('content')
	<div class="uk-grid uk-grid-width-large-1-5 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
        <div>
            <div class="md-card">
                <div class="md-card-content">
                	<div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="material-icons md-color-yellow-900">pending_actions</i></div>
                    <span class="uk-text-muted uk-text-small">Pending Orders</span>
                    <h2 class="uk-margin-remove"><span>{{ $data->pending_orders }}</span></h2>
                </div>
            </div>
        </div>
        <div>
            <div class="md-card">
                <div class="md-card-content">
                	<div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="material-icons md-color-green-500">check_circle</i></div>
                    <span class="uk-text-muted uk-text-small">Succeed Orders</span>
                    <h2 class="uk-margin-remove"><span>{{ $data->succeed_orders }}</span></h2>
                </div>
            </div>
        </div>
        <div>
            <div class="md-card">
                <div class="md-card-content">
                	<div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="material-icons md-color-red-500">receipt_long</i></div>
                    <span class="uk-text-muted uk-text-small">Total Transactions</span>
                    <h2 class="uk-margin-remove"><span>{{ $data->total_orders }}</span></h2>
                </div>
            </div>
        </div>
        <div>
            <div class="md-card">
                <div class="md-card-content">
                	<div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="material-icons md-color-blue-500">people</i></div>
                    <span class="uk-text-muted uk-text-small">Verified Users</span>
                    <h2 class="uk-margin-remove"><span>{{ $data->verified_users }}</span></h2>
                </div>
            </div>
        </div>
        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="material-icons md-color-yellow-500">group_add</i></div>
                    <span class="uk-text-muted uk-text-small">Total Refers</span>
                    <h2 class="uk-margin-remove"><span>{{ $data->total_refers }}</span></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="md-card">
        <div class="uk-grid">
            <div class="uk-width-1-2">
                <form method="post" action="{{ route('admin_setting_store') }}" enctype="multipart/form-data" class="uk-margin-bottom uk-margin-top">
                    @csrf
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
                            <label for="rate" class="uk-vertical-align-middle uk-text-bold">Rate:</label>
                        </div>
                        <div class="uk-width-medium-4-5">
                            <label for="rate">Rate</label>
                            <input type="number" step="any" class="md-input" id="rate" name="rate" value="{{ $data->rate }}" required="">
                            @error('rate')
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
    </div>

    <div class="md-card">
        <div class="md-card-content">
            <h4 class="heading_c uk-margin-bottom">Orders</h4>
            <div id="chartist_line_area" class="chartist"></div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('backend/bower_components/chartist/dist/chartist.min.js') }}"></script>

    {{-- <script src="{{ asset('backend/assets/js/pages/plugins_charts.js') }}"></script> --}}

    <script type="text/javascript">
        var amounts = @json($amounts);

        $(function() {
           altair_charts.chartist_charts()
        }), altair_charts = {
            chartist_charts: function() {
                var t = new Chartist.Line("#chartist_line_area", {
                    labels: [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ],
                    series: [
                        amounts
                    ]
                }, {
                    low: 0,
                    showArea: !0
                });
            }
        };
    </script>

	<script type="text/javascript">
		$('.sidebar_dashboard').addClass('current_section');
	</script>
@endsection