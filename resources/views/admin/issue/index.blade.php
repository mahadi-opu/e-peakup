@extends('layouts.backend')

@section('title', 'Issues')

@section('content')
	
	<div class="md-card uk-margin-medium-bottom">

		<div class="user_heading uk-sticky-placeholder" data-uk-sticky="{ top: 48, media: 960 }">
		    <div class="user_heading_content">
		        <h2 class="heading_b">
	        		<span>List of Issues</span>
		        </h2>
		    </div>
		</div>

	    <div class="md-card-content">
	    	<div class="dt_colVis_buttons"></div>
            <table id="dt_tableExport" class="uk-table uk-table-hover" cellspacing="0" width="100%">
	            <thead>
		            <tr>
		            	<th>#</th>
		            	<th>Name</th>
		            	<th>Email</th>
		            	<th>Subject</th>
		            	<th>Message</th>
		                <th>Actions</th>
		            </tr>
	            </thead>

	            <tfoot>
		            <tr>
		            	<th>#</th>
		            	<th>Name</th>
		            	<th>Email</th>
		            	<th>Subject</th>
		            	<th>Message</th>
		                <th>Actions</th>
		            </tr>
	            </tfoot>

	            <tbody>
	            @foreach ($issues as $issue)
		            <tr>
		                <td>{{ $loop->index+1 }}</td>
		                <td>{{ $issue->name }}</td>
		                <td>{{ $issue->email }}</td>
		                <td>{{ $issue->subject }}</td>
		                <td>{{ $issue->message }}</td>
		                <td>
		                	<a data-uk-modal="{target: '#editModal{{ $issue->id }}'}"><i class="material-icons uk-text-primary md-icon" data-uk-tooltip title="Edit">create</i></a>
		                </td>
		            </tr>
	            @endforeach
	            </tbody>
	        </table>
	    </div>
	</div>

@endsection

@section('scripts')

	<script type="text/javascript">
		$('.sidebar_issues').addClass('current_section');
	</script>

@endsection