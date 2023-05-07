@extends('layouts.backend')

@section('title', 'Payment Orders')

@section('content')
	
	<div class="md-card uk-margin-medium-bottom">

		<div class="user_heading uk-sticky-placeholder" data-uk-sticky="{ top: 48, media: 960 }">
		    <div class="user_heading_content">
		        <h2 class="heading_b uk-float-left">
	        		<span>List of Payment Orders</span>
		        </h2>
		        <form action="{{ route('admin_order_index') }}" method="get">
	                <div class="uk-grid">
	                    <div class="uk-width-1-4">
	                        <select name="status" id="status" onchange="this.form.submit()" data-md-selectize data-md-selectize-bottom>
	                            <option value="">Filter...</option>
	                            <option value="1" {{ $status_selected && isset($selected_status) && $selected_status == 1 ? 'selected' : '' }}>Confirmed</option>
	                            <option value="0" {{ $status_selected && isset($selected_status) && $selected_status == 0 ? 'selected' : '' }}>Pending</option>
	                        </select>
	                    </div>
	                    <div class="uk-width-1-4">
	                        <a href="{{ route('admin_order_index') }}" class="md-btn md-btn-primary md-btn-block md-btn-wave-light waves-effect waves-button waves-light">Reset</a>
	                    </div>
	                </div>
	            </form>
		    </div>
		</div>

	    <div class="md-card-content">

            <table id="dt_tableExport" class="uk-table uk-table-hover" cellspacing="0" width="100%">
	            <thead>
		            <tr>
		            	<th>#</th>
		            	<th>Order Id</th>
		            	<th>Sender</th>
		            	<th>Recipient</th>
		            	<th>Pay With</th>
		            	<th>Service</th>
		            	<th>Method</th>
		            	<th>Amount(BDT)</th>
		            	<th>Account Number</th>
		            	<th>Date</th>
		            	<th>Time</th>
		            	<th>Status</th>
		                <th>Actions</th>
		            </tr>
	            </thead>

	            <tbody>
	            @foreach ($orders as $order)
		            <tr>
		                <td>{{ $loop->index+1 }}</td>
		                <td>{{ $order->order_id }}</td>
		                <td>{{ $order->user->name }}</td>
		                <td>{{ $order->recipient->name }}</td>
		                <td>{{ ucfirst($order->payment_method_global) }}</td>
		                <td>{{ $order->service->name }}</td>
		                <td>{{ $order->payment_method->name }}</td>
		                <td>Tk {{ $order->recipient_amount }}</td>
		                <td>{{ $order->recipient->number }}</td>
		                <td>{{ $order->created_at->format('Y-m-d') }}</td>
		                <td>{{ $order->created_at->format('h:i A') }}</td>
		                <td>
		                	@if ($order->status)
		                		<span class="uk-badge uk-badge-success">Succeed</span>
		                	@else
		                		<span class="uk-badge uk-badge-warning">Pending</span>
		                	@endif
		                </td>
		                <td>
		                	<a data-uk-modal="{target: '#viewModal{{ $order->id }}'}"><i class="material-icons uk-text-success md-icon" data-uk-tooltip title="Edit">visibility</i></a>
		                	<a data-uk-modal="{target: '#sendModal{{ $order->id }}'}"><i class="material-icons uk-text-danger md-icon" data-uk-tooltip title="Send">email</i></a>
		                </td>
		            </tr>
	            @endforeach
	            </tbody>
	        </table>
	    </div>
	</div>

    @foreach ($orders as $order)
    {{-- View Modal --}}
		<div class="uk-modal" id="viewModal{{ $order->id }}">
			<div class="user_heading">
			    <div class="user_heading_content">
			        <h2 class="heading_b uk-text-center"><span>Order Details</span></h2>
			    </div>
			</div>
	        <div class="uk-modal-dialog">
	            <button type="button" class="uk-modal-close uk-close"></button>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Order Id:</label>
	                </div>
	                <div class="uk-width-medium-3-5">{{ $order->order_id }}</div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Send Amount:</label>
	                </div>
	                <div class="uk-width-medium-3-5">{{ $order->amount }}</div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Recipient Amount:</label>
	                </div>
	                <div class="uk-width-medium-3-5">{{ $order->recipient_amount }}</div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Pay With:</label>
	                </div>
	                <div class="uk-width-medium-3-5">{{ ucfirst($order->payment_method_global) }}</div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Method:</label>
	                </div>
	                <div class="uk-width-medium-3-5">{{ $order->payment_method->name }}</div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Status:</label>
	                </div>
	                <div class="uk-width-medium-3-5">
	                	@if ($order->status)
	                		<span class="uk-badge uk-badge-success">Confirmed</span>
	                	@else
	                		<span class="uk-badge uk-badge-warning">Pending</span>
	                	@endif
	                </div>
	            </div>

	            <hr>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Sender:</label>
	                </div>
	                <div class="uk-width-medium-3-5">{{ $order->user->name }}</div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Recipient:</label>
	                </div>
	                <div class="uk-width-medium-3-5">{{ $order->recipient->name }}</div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Recipient Email:</label>
	                </div>
	                <div class="uk-width-medium-3-5">{{ $order->recipient->email }}</div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Recipient Number:</label>
	                </div>
	                <div class="uk-width-medium-3-5">{{ $order->recipient->number }}</div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
	                    <label class="uk-vertical-align-middle uk-text-bold">Recipient Account Type:</label>
	                </div>
	                <div class="uk-width-medium-3-5">{{ $order->recipient->recipient_account_type->name }}</div>
	            </div>

	            @if (!$order->status)
		            <form method="post" action="{{ route('admin_order_done') }}" class="uk-margin-top">
		            	@csrf
		            	<input type="hidden" name="order_id" value="{{ $order->id }}">
	                	<button type="submit" class="md-btn md-btn-block md-btn-success">Mark as Confirmed</button>
	                </form>
	            @endif

	        </div>
	    </div>
    @endforeach

    @foreach ($orders as $order)
    	<div class="uk-modal" id="sendModal{{ $order->id }}">
			<div class="user_heading">
			    <div class="user_heading_content">
			        <h2 class="heading_b uk-text-center"><span>Send Mail</span></h2>
			    </div>
			</div>
	        <div class="uk-modal-dialog">
	            <button type="button" class="uk-modal-close uk-close"></button>

	            <form method="post" action="{{ route('admin_order_mail_send', $order->id) }}">
	            	@csrf
		            <div class="uk-grid">
		            	<div class="uk-width-medium-2-5 uk-vertical-align uk-text-right">
		                    <label class="uk-vertical-align-middle uk-text-bold">Email:</label>
		                </div>
		                <div class="uk-width-medium-3-5">{{ $order->user->email }}</div>
		            </div>

		            <div class="uk-grid">
		            	<div class="uk-width-medium-2-5 uk-vertical-align uk-text-right"></div>
		                <div class="uk-width-medium-3-5">
		                	<button type="submit" class="md-btn md-btn-success">Send</button>
		                </div>
		            </div>
	            </form>

	        </div>
	    </div>
    @endforeach

@endsection

@section('scripts')

	<script type="text/javascript">
		$('.sidebar_orders').addClass('current_section');
	</script>

	<!-- page specific plugins -->
    <!-- datatables -->
    <script src="{{ asset('backend/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <!-- datatables buttons-->
    <script src="{{ asset('backend/bower_components/datatables-buttons/js/dataTables.buttons.js') }}"></script>
    <script src="{{ asset('backend/assets/js/custom/datatables/buttons.uikit.js') }}"></script>
    <script src="{{ asset('backend/bower_components/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/bower_components/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/bower_components/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/bower_components/datatables-buttons/js/buttons.colVis.js') }}"></script>
    <script src="{{ asset('backend/bower_components/datatables-buttons/js/buttons.html5.js') }}"></script>
    <script src="{{ asset('backend/bower_components/datatables-buttons/js/buttons.print.js') }}"></script>

    <!-- datatables custom integration -->
    <script src="{{ asset('backend/assets/js/custom/datatables/datatables.uikit.min.js') }}"></script>

    <!--  datatables functions -->
    <script src="{{ asset('backend/assets/js/pages/plugins_datatables.min.js') }}"></script>

@endsection