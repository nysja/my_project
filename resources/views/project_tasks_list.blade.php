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
				<div class="panel-heading">Project tasks
					@if(Auth::user()->getUserRole(Auth::user()->id) == 'site_manager' || Auth::user()->getUserRole(Auth::user()->id) == 'super_admin')
					<button class="navbar-right">
						 <a href="{{ url('/project_task_add') }}">Add project task</a>
					</button>
					@endif
				</div>
				
				<div class="panel-body">
					<table>
						<tr>
							<th>Project task description</th>
							<th>Project task status</th>
							<th>Project name</th>
							<th>Performer</th>
							<th></th>
						</tr> 
					
					@foreach ($project_tasks as $item) 
						<tr>
							<td>{{$item->project_task_description}}</td>
							<td>{{$item->project_task_status}}</td>
							<td>{{$item->project_name}}</td>
							<td>{{$item->name.' '.$item->last_name}}</td>
							<td><button> <a href="{{ url('/project_task/'.$item->project_tasks_id) }}">Edit project task</a></button></td>
						</tr>   
					@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
  

