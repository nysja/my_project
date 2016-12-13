@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
			@endif
			<div class="panel panel-default">
				<div class="panel-heading">Users
					<button class="navbar-right">
						 <a href="{{ url('/user_add') }}">Add user</a>
					</button>
				</div>
				
				<div class="panel-body">
					<table>
						<tr>
							<th>User name</th>
							<th>User last name</th>
							<th>Login</th>
							<th>User email</th>
							<th>Company name</th>
							<th></th>
						</tr> 
					
					@foreach ($users as $item) 
						<tr>
							<td>{{$item->name}}</td>
							<td>{{$item->last_name}}</td>
							<td>{{$item->login}}</td>
							<td>{{$item->email}}</td>
							<td>{{$item->company_name}}</td>
							<td><button> <a href="{{ url('/user/'.$item->id) }}">Edit user</a></button></td>
						</tr>   
					@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
  

