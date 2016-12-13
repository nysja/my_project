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
				<div class="panel-heading">Add new project</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/project/add') }}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('project_name') ? ' has-error' : '' }}">
							<label for="project_name" class="col-md-4 control-label">Project Name</label>

							<div class="col-md-6">
								<input id="project_name" type="text" class="form-control" name="project_name" required autofocus> 

								@if ($errors->has('project_name'))
									<span class="help-block">
										<strong>{{ $errors->first('project_name') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('project_description') ? ' has-error' : '' }}">
							<label for="project_description" class="col-md-4 control-label">Project description</label>

							<div class="col-md-6">
								<input id="project_description" type="text" class="form-control" name="project_description" required autofocus>

								@if ($errors->has('project_description'))
									<span class="help-block">
										<strong>{{ $errors->first('project_description') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						
						<div class="form-group{{ $errors->has('project_costs') ? ' has-error' : '' }}">
							<label for="project_costs" class="col-md-4 control-label">Login</label>

							<div class="col-md-6">
								<input id="project_costs" type="text" class="form-control" name="project_costs" required autofocus> 

								@if ($errors->has('project_costs'))
									<span class="help-block">
										<strong>{{ $errors->first('project_costs') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						<div class="form-group">
							<label for="company_id" class="col-md-4 control-label">Select Company:</label>

							<div class="col-md-6">
								<select id="company_id" type="text" class="form-control" name="company_id" required>
									@foreach($companies as $company)
									  <option value="{{$company['company_id']}}">{{$company['company_name']}}</option>
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
  

