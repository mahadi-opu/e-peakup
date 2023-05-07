@extends('layouts.backend')

@section('title', 'Sliders')

@section('content')
	
	<div class="md-card uk-margin-medium-bottom">

		<div class="user_heading uk-sticky-placeholder" data-uk-sticky="{ top: 48, media: 960 }">
		    <div class="user_heading_content">
		        <h2 class="heading_b">
	        		<span>List of Sliders</span>
		        </h2>
		    </div>
		</div>

	    <div class="md-card-content">
	    	<div class="dt_colVis_buttons"></div>
            <table id="dt_tableExport" class="uk-table uk-table-hover" cellspacing="0" width="100%">
	            <thead>
		            <tr>
		            	<th>#</th>
		            	<th>Image</th>
		            	<th>Status</th>
		                <th>Actions</th>
		            </tr>
	            </thead>

	            <tfoot>
		            <tr>
		            	<th>#</th>
		            	<th>Image</th>
		            	<th>Status</th>
		                <th>Actions</th>
		            </tr>
	            </tfoot>

	            <tbody>
	            @foreach ($notices as $notice)
		            <tr>
		                <td>{{ $loop->index+1 }}</td>
		                <td>
		                	<a href="{{ asset($notice->notice) }}" data-uk-lightbox data-uk-tooltip title="View full image">
		                		<img src="{{ asset($notice->notice) }}" width="60" alt="Not found">
		                	</a>
		                </td>
		                <td>
		                	@if ($notice->status)
		                		<span class="uk-badge uk-badge-success">Shown</span>
		                	@else
		                		<span class="uk-badge uk-badge-danger">Hidden</span>
		                	@endif
		                </td>
		                <td>
		                	<a data-uk-modal="{target: '#editModal{{ $notice->id }}'}"><i class="material-icons uk-text-primary md-icon" data-uk-tooltip title="Edit">create</i></a>
		                	<a href="{{ route('admin_notice_delete', $notice->id) }}" onclick="deleterow(this); return false"><i class="material-icons uk-text-danger md-icon" data-uk-tooltip title="Delete">delete</i></a>
		                </td>
		            </tr>
	            @endforeach
	            </tbody>
	        </table>
	    </div>
	</div>

	<div class="md-fab-wrapper">
        <a data-uk-modal="{target:'#createModal'}" class="md-fab md-fab-accent">
            <i class="material-icons">add</i>
        </a>
    </div>

    {{-- Create Modal --}}
	<div class="uk-modal create_modal" id="createModal">
    	<div class="user_heading">
		    <div class="user_heading_content">
		        <h2 class="heading_b uk-text-center"><span>Add A Slider</span></h2>
		    </div>
		</div>
        <div class="uk-modal-dialog">
            <button type="button" class="uk-modal-close uk-close"></button>
            <form method="post" action="{{ route('admin_notice_store') }}" enctype="multipart/form-data">
            	@csrf

            	<div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
	                    <label for="notice" class="uk-vertical-align-middle uk-text-bold">Image:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <input class="dropify" type="file" id="notice" name="notice" required="">
	                    @error('notice')
	                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
	                    @enderror
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
	                    <label for="status" class="uk-vertical-align-middle uk-text-bold">Status:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <input type="checkbox" name="status" data-switchery checked id="status" value="1">
                        <label for="status" class="inline-label">Status</label>
	                    @error('status')
	                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
	                    @endif
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

    {{-- Edit Modal --}}
    @foreach ($notices as $notice)
		<div class="uk-modal" id="editModal{{ $notice->id }}">
			<div class="user_heading">
			    <div class="user_heading_content">
			        <h2 class="heading_b uk-text-center"><span>{{ $notice->name }}</span></h2>
			    </div>
			</div>
	        <div class="uk-modal-dialog">
	            <button type="button" class="uk-modal-close uk-close"></button>
	            <form method="post" action="{{ route('admin_notice_update', $notice->id) }}" enctype="multipart/form-data">
	            	@csrf
	            	@method('PUT')

	            	<div class="uk-grid" data-uk-grid-margin>
		                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
		                    <label for="notice{{ $notice->id }}" class="uk-vertical-align-middle uk-text-bold">Image:</label>
		                </div>
		                <div class="uk-width-medium-4-5">
		                    <input class="dropify" type="file" id="notice{{ $notice->id }}" name="notice" data-default-file="{{ asset($notice->notice) }}">
		                    @error('notice')
		                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
		                    @enderror
		                </div>
		            </div>

		            <div class="uk-grid" data-uk-grid-margin>
		                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
		                    <label for="status" class="uk-vertical-align-middle uk-text-bold">Status:</label>
		                </div>
		                <div class="uk-width-medium-4-5">
		                    <input type="checkbox" name="status" data-switchery {{ $notice->status ? 'checked' : '' }} value="1">
	                        <label for="status" class="inline-label">Status</label>
		                    @error('status')
		                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
		                    @endif
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
    @endforeach

@endsection

@section('scripts')

	<script type="text/javascript">
		$('.sidebar_cms').addClass('current_section');
	</script>

@endsection