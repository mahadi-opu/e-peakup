@extends('layouts.backend')

@section('title', 'Live Chat')
	
@section('content')
	<iframe src="https://www.mylivechat.com/webconsole/" width="100%" height="600" frameborder="0"></iframe>
@stop

@section('scripts')
	<script type="text/javascript">
		$('.sidebar_live_chat').addClass('current_section');
	</script>
@endsection