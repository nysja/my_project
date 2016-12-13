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
				<div class="panel-heading">Project task</div>
				@foreach ($project_tasks as $item)
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/project_task/'.$item->project_tasks_id) }}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('project_task_description') ? ' has-error' : '' }}">
							<label for="project_task_description" class="col-md-4 control-label">Project task description</label>

							<div class="col-md-6">
								<input id="project_task_description" type="text" class="form-control" name="project_task_description" value="{{ old('project_task_description', $item->project_task_description) }}" required autofocus> 

								@if ($errors->has('project_task_description'))
									<span class="help-block">
										<strong>{{ $errors->first('project_task_description') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('project_task_status') ? ' has-error' : '' }}">
							<label for="project_task_status" class="col-md-4 control-label">Project task status</label>

							<div class="col-md-6">
								<input id="project_task_status" type="text" class="form-control" name="project_task_status" value="{{ old('project_task_status', $item->project_task_status) }}" required autofocus>

								@if ($errors->has('project_task_status'))
									<span class="help-block">
										<strong>{{ $errors->first('project_task_status') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						
						<div class="form-group{{ $errors->has('project_costs') ? ' has-error' : '' }}">
							<label for="project_name" class="col-md-4 control-label">Project name</label>

							<div class="col-md-6">
								<input id="project_name" type="text" class="form-control" name="project_name" value="{{ old('project_name', $item->project_name) }}" required autofocus> 

								@if ($errors->has('project_name'))
									<span class="help-block">
										<strong>{{ $errors->first('project_name') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						<div class="form-group">
							<label for="user" class="col-md-4 control-label">Performer</label>

							<div class="col-md-6">
								<input id="user" type="text" class="form-control" name="user" value="{{ old('user', $item->name.' '.$item->last_name) }}" required autofocus> 

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
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection
  

