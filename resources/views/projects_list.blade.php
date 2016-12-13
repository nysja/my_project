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
				<div class="panel-heading">Project
					@if(Auth::user()->getUserRole(Auth::user()->id) == 'site_manager' || Auth::user()->getUserRole(Auth::user()->id) == 'super_admin')
					<button class="navbar-right">
						 <a href="{{ url('/project_add') }}">Add project</a>
					</button>
					@endif
				</div>
				
				<div class="panel-body">
					<table>
						<tr>
							<th>Project name</th>
							<th>Project description</th>
							<th>Project cost</th>
							<th>Company name</th>
							<th></th>
						</tr> 
					
					@foreach ($projects as $item) 
						<tr>
							<td>{{$item->project_name}}</td>
							<td>{{$item->project_description}}</td>
							<td>{{$item->project_costs}}</td>
							<td>{{$item->company_name}}</td>
							<td><button> <a href="{{ url('/project/'.$item->project_id) }}">Edit project</a></button></td>
						</tr>   
					@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
  

