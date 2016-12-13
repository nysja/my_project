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
				<div class="panel-heading">Company</div>
				@foreach ($companies as $item)
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/company/'.$item['company_id']) }}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="col-md-4 control-label">Company Name</label>

							<div class="col-md-6">
								<input id="name" type="text" class="form-control" name="name" value="{{ old('name', $item['company_name']) }}" required autofocus> 

								@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('company_person') ? ' has-error' : '' }}">
							<label for="company_person" class="col-md-4 control-label">Contact Person</label>

							<div class="col-md-6">
								<input id="company_person" type="text" class="form-control" name="person" value="{{ old('person', $item['company_contact_person']) }}" required autofocus>

								@if ($errors->has('company_person'))
									<span class="help-block">
										<strong>{{ $errors->first('company_person') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						
						<div class="form-group{{ $errors->has('company_phone') ? ' has-error' : '' }}">
							<label for="company_phone" class="col-md-4 control-label">Company phone</label>

							<div class="col-md-6">
								<input id="company_phone" type="text" class="form-control" name="phone" value="{{ old('phone', $item['company_phone']) }}" required autofocus> 

								@if ($errors->has('company_phone'))
									<span class="help-block">
										<strong>{{ $errors->first('company_phone') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('company_email') ? ' has-error' : '' }}">
							<label for="email" class="col-md-4 control-label">Company E-Mail</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control" name="email" value="{{ old('email', $item['company_emails']) }}" required> 

								@if ($errors->has('company_email'))
									<span class="help-block">
										<strong>{{ $errors->first('company_email') }}</strong>
									</span>
								@endif
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
  

