@extends('layouts.backend')

@section('title', 'Subcribes')

@section('content')
	
	<div class="md-card uk-margin-medium-bottom">

		<div class="user_heading uk-sticky-placeholder" data-uk-sticky="{ top: 48, media: 960 }">
		    <div class="user_heading_content">
		        <h2 class="heading_b">
	        		<span>List of Subcribes</span>
		        </h2>
		    </div>
		</div>

	    <div class="md-card-content">
	    	<div class="dt_colVis_buttons"></div>
            <table id="dt_tableExport" class="uk-table uk-table-hover" cellspacing="0" width="100%">
	            <thead>
		            <tr>
		            	<th>#</th>
		            	<th>Email</th>
		            </tr>
	            </thead>

	            <tfoot>
		            <tr>
		            	<th>#</th>
		            	<th>Email</th>
		            </tr>
	            </tfoot>

	            <tbody>
		            @foreach ($subscribes as $subscribe)
			            <tr>
			                <td>{{ $loop->index+1 }}</td>
			                <td>{{ $subscribe->email }}</td>
			            </tr>
		            @endforeach
	            </tbody>
	        </table>
	    </div>
	</div>

@endsection

@section('scripts')

	<script type="text/javascript">
		$('.sidebar_subscribes').addClass('current_section');
	</script>

@endsection