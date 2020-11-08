@if(Session::has('Error-alert'))
		<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Error!</strong> {{ Session::get('Error-alert') }}
		</div>
@endif

@if(Session::has('Success-alert'))
		<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Success!</strong> {{ Session::get('Success-alert') }}
		</div>
@endif

@if(Session::has('Info-alert'))
		<div class="alert alert-info alert-dismissible">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Info!</strong> {{ Session::get('Info-alert') }}
		</div>
@endif

@if(Session::has('Warning-alert'))
		<div class="alert alert-warning alert-dismissible">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Warning!</strong> {{ Session::get('Warning-alert') }}
		</div>
@endif