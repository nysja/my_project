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
				<div class="panel-heading">Send request form</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/company_request') }}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="col-md-4 control-label">Contact person</label>

							<div class="col-md-6">
								<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

								@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="col-md-4 control-label">E-Mail Address</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
							<label for="company_name" class="col-md-4 control-label">Company name</label>

							<div class="col-md-6">
								<input id="company_name" type="text" class="form-control" name="company_name" required>

								@if ($errors->has('company_name'))
									<span class="help-block">
										<strong>{{ $errors->first('company_name') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('project_request') ? ' has-error' : '' }}">
							<label for="project_request" class="col-md-4 control-label">Project request</label>

							<div class="col-md-6">
								<input id="project_request" type="text" class="form-control" name="project_request" required>

								@if ($errors->has('project_request'))
									<span class="help-block">
										<strong>{{ $errors->first('project_request') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Send for examination
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
  

