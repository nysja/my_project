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
				@foreach ($users as $item)
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/user/'.$item->id) }}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="col-md-4 control-label">User Name</label>

							<div class="col-md-6">
								<input id="name" type="text" class="form-control" name="name" value="{{ old('name', $item->name) }}" required autofocus> 

								@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
							<label for="last_name" class="col-md-4 control-label">Last name</label>

							<div class="col-md-6">
								<input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name', $item->last_name) }}" required autofocus>

								@if ($errors->has('last_name'))
									<span class="help-block">
										<strong>{{ $errors->first('last_name') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						
						<div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
							<label for="login" class="col-md-4 control-label">Login</label>

							<div class="col-md-6">
								<input id="login" type="text" class="form-control" name="login" value="{{ old('login', $item->login) }}" required autofocus> 

								@if ($errors->has('login'))
									<span class="help-block">
										<strong>{{ $errors->first('login') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="col-md-4 control-label">Email</label>

							<div class="col-md-6">
								<input id="email" type="text" class="form-control" name="email" value="{{ old('email', $item->email) }}" required autofocus> 

								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						<div class="form-group">
							<label for="company_id" class="col-md-4 control-label">User Company:</label>

							<div class="col-md-6">
								<select id="company_id" type="text" class="form-control" name="company_id" required>
									@foreach($companies as $company)
										@if($company['company_id'] == $item->company_id)
											 <option value="{{$item->company_id}}" selected="selected">{{$item->company_name}}</option>
										@else
											 <option value="{{$company['company_id']}}">{{$company['company_name']}}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="role_id" class="col-md-4 control-label">User Role:</label>

							<div class="col-md-6">
								<select id="role_id" type="text" class="form-control" name="role_id" required>
									@foreach($roles as $role)
										@if($role['id'] == $item->role_id)
											 <option value="{{$role['id']}}" selected="selected">{{$role['description']}}</option>
										@else
											 <option value="{{$role['id']}}">{{$role['description']}}</option>
										@endif    
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
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection
  

