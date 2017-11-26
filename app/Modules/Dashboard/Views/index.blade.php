@extends('main')
@section('title', 'Dashboards')
@section('content')

<div class="row  border-bottom white-bg dashboard-header">
	<div class="col-md-3">
			<h2>Welcome {{ session('session_login')['username'] }}</h2>
	</div>	
	</div class="row">&nbsp;</div>
</div>


@endsection