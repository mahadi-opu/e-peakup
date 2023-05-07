@extends('layouts.backend')

@section('title', 'Admins')
	
@section('content')
	<div class="md-card uk-margin-medium-bottom">

		<div class="user_heading uk-sticky-placeholder" data-uk-sticky="{ top: 48, media: 960 }">
		    <div class="user_heading_content">
		        <h2 class="heading_b">
	        		<span>List of Admins</span>
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
		            	<th>Name</th>
		            	<th>Role</th>
		            	<th>Email</th>
		            	<th>Phone</th>
		                <th>Actions</th>
		            </tr>
	            </thead>

	            <tfoot>
		            <tr>
		            	<th>#</th>
		            	<th>Image</th>
		            	<th>Name</th>
		            	<th>Role</th>
		            	<th>Email</th>
		            	<th>Phone</th>
		                <th>Actions</th>
		            </tr>
	            </tfoot>

	            <tbody>
	            @foreach ($admins as $admin)
		            <tr>
		                <td>{{ $loop->index+1 }}</td>
		                <td>
		                	@if ($admin->image)
			                	<a href="{{ asset($admin->image) }}" data-uk-lightbox data-uk-tooltip title="View full image">
			                		<img src="{{ asset($admin->image) }}" class="uk-border-circle" width="60" alt="Not found">
			                	</a>
			                @else
			                	<img src="{{ asset('backend/assets/img/default-avatar.png') }}" class="uk-border-circle" width="60" title="Not Found" data-uk-tooltip alt="Not found">
		                	@endif
		                </td>
		                <td>{{ $admin->name }}</td>
		                <td>{{ $admin->role->name }}</td>
		                <td>{{ $admin->email }}</td>
		                <td>{{ $admin->phone }}</td>
		                <td>
		                	<a data-uk-modal="{target: '#editModal{{ $admin->id }}'}"><i class="material-icons uk-text-primary md-icon" data-uk-tooltip title="Edit">create</i></a>
		                	@if ($admin->id != 1)
			                	<a href="{{ route('admin_admin_delete', $admin->id) }}" onclick="deleterow(this); return false" data-uk-tooltip title="Delete">
			                		<i class="uk-text-danger material-icons">delete</i>
			                	</a>
		                	@endif
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
		        <h2 class="heading_b uk-text-center"><span>Add an Admin</span></h2>
		    </div>
		</div>
        <div class="uk-modal-dialog">
            <button type="button" class="uk-modal-close uk-close"></button>
            <form method="post" action="{{ route('admin_admin_store') }}" enctype="multipart/form-data">
            	@csrf

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
	                    <label for="name" class="uk-vertical-align-middle uk-text-bold">Name:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <label for="name">Name</label>
	                    <input class="md-input" type="text" id="name" name="name" value="{{ old('name') }}" required="">
	                    @error('name')
	                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
	                    @enderror
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
	                    <label for="email" class="uk-vertical-align-middle uk-text-bold">Email:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <label for="email">Email</label>
	                    <input class="md-input" type="email" id="email" name="email" value="{{ old('email') }}" required="">
	                    @error('email')
	                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
	                    @enderror
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
	                    <label for="password" class="uk-vertical-align-middle uk-text-bold">Password:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <label for="password">Password</label>
	                    <input class="md-input" type="password" id="password" name="password" value="{{ old('password') }}" required="">
	                    @error('password')
	                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
	                    @enderror
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
	                    <label for="phone" class="uk-vertical-align-middle uk-text-bold">Phone:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <label for="phone">Phone</label>
	                    <input class="md-input" type="tel" id="phone" name="phone" value="{{ old('phone') }}" required="">
	                    @error('phone')
	                        <span class="uk-margin-top uk-text-danger">{{ $message }}</span>
	                    @enderror
	                </div>
	            </div>

	            <div class="uk-grid" data-uk-grid-margin>
	                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
	                    <label for="role_id" class="uk-vertical-align-middle uk-text-bold">Role:</label>
	                </div>
	                <div class="uk-width-medium-4-5">
	                    <label for="role_id">Role</label>
	                    <select name="role_id" required="">
	                    	<option value="">Select...</option>
	                    	@foreach ($roles as $admin_role)
	                    		<option value="{{ $admin_role->id }}" {{ old('role_id') == $admin_role->id ? 'selected' : '' }}>{{ $admin_role->name }}</option>
	                    	@endforeach
	                    </select>
	                    @error('role_id')
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

    {{-- Edit Modal --}}
    @foreach ($admins as $admin)
		<div class="uk-modal" id="editModal{{ $admin->id }}">
			<div class="user_heading">
			    <div class="user_heading_content">
			        <h2 class="heading_b uk-text-center"><span>{{ $admin->name }}</span></h2>
			    </div>
			</div>
	        <div class="uk-modal-dialog">
	            <button type="button" class="uk-modal-close uk-close"></button>
	            <form method="post" action="{{ route('admin_admin_update', $admin->id) }}" enctype="multipart/form-data">
	            	@csrf
	            	@method('PUT')

		            <div class="uk-grid" data-uk-grid-margin>
		                <div class="uk-width-medium-1-5 uk-vertical-align uk-text-right">
		                    <label for="name{{ $admin->id }}" class="uk-vertical-align-middle uk-text-bold">Name:</label>
		                </div>
		                <div class="uk-width-medium-4-5">
		                    <label for="name">Name</label>
		                    <input class="md-input" type="text" id="name{{ $admin->id }}" name="name" value="{{ $admin->name }}" required="">
		                    @error('name')
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
    @endforeach
@stop

@section('scripts')
	<script type="text/javascript">
		$('.sidebar_admins').addClass('current_section');
	</script>
@stop