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
				<div class="panel-heading">Add new project task</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/project_task/add') }}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('project_name') ? ' has-error' : '' }}">
							<label for="project_task_description" class="col-md-4 control-label">Project task description</label>

							<div class="col-md-6">
								<input id="project_task_description" type="text" class="form-control" name="project_task_description" required autofocus> 

								@if ($errors->has('project_task_description'))
									<span class="help-block">
										<strong>{{ $errors->first('project_task_description') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('project_task_status') ? ' has-error' : '' }}">
							<label for="project_task_status" class="col-md-4 control-label">Project status</label>

							<div class="col-md-6">
								<input id="project_task_status" type="text" class="form-control" name="project_task_status" required autofocus>

								@if ($errors->has('project_task_status'))
									<span class="help-block">
										<strong>{{ $errors->first('project_task_status') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						<div class="form-group">
							<label for="project_id" class="col-md-4 control-label">Select project:</label>

							<div class="col-md-6">
								<select id="project_id" type="text" class="form-control" name="v" required>
									@foreach($projects as $project)
									  <option value="{{$project->project_id}}">{{$project->project_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label for="user_id" class="col-md-4 control-label">Select user:</label>

							<div class="col-md-6">
								<select id="user_id" type="text" class="form-control" name="user_id" required>
									@foreach($users as $user)
									  <option value="{{$user->id}}">{{$user->name.' '.$user->last_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Save
								</button>
							</div>
						</div>
					</form>
				</div> 
			</div>
		</div>
	</div>
</div>
@endsection
  

