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
				<div class="panel-heading">Companies
					<button class="navbar-right">
						 <a href="{{ url('/company_add') }}">Add company</a>
					</button>
				</div>
				
				<div class="panel-body">
					<table>
						<tr>
							<th>Company name</th>
							<th>Contact person</th>
							<th>Company email</th>
							<th>Company phone</th>
							<th></th>
						</tr> 
					
					@foreach ($companies as $item) 
						<tr>
							<td>{{$item['company_name']}}</td>
							<td>{{$item['company_contact_person']}}</td>
							<td>{{$item['company_emails']}}</td>
							<td>{{$item['company_phone']}}</td>
							<td><button> <a href="{{ url('/company/'.$item['company_id']) }}">Edit company</a></button></td>
						</tr>   
					@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
  

