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
				<div class="panel-heading">Companies requests list</div>

				<div class="panel-body">
					<table>
						<tr>
							<th>Company name</th>
							<th>Contact person</th>
							<th>Email</th>
							<th>Project request description</th>
							<th>Processed</th>
						</tr> 
					
					@foreach ($list as $item) 
						<tr>
							<td>{{$item['company_name']}}</td>
							<td>{{$item['contact_person']}}</td>
							<td>{{$item['email']}}</td>
							<td>{{$item['project_request']}}</td>
							<td>{{$item['processed']}}</td>
						</tr>   
					@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
  

