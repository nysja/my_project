<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Styles -->
	<link href="/css/app.css" rel="stylesheet">

	<!-- Scripts -->
	<script>
		window.Laravel = <?php echo json_encode([
			'csrfToken' => csrf_token(),
		]); ?>
	</script>
</head>
<body>
	<div id="app">
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">

					<!-- Collapsed Hamburger -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<!-- Branding Image -->
					<a class="navbar-brand" href="{{ url('/') }}">
						{{ config('app.name', 'Laravel') }}
					</a>
				</div>

				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<!-- Left Side Of Navbar -->
					<ul class="nav navbar-nav">
						&nbsp;
					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
						<!-- Authentication Links -->
						@if (Auth::guest())
							<li><a href="{{ url('/login') }}">Login</a></li>
							@if(Request::path() == 'company_request')
							<li></li>
							@else
							<li><a href="{{ url('/company_request') }}">Send request to become a client</a></li>  
							@endif
						@else
							@if(Auth::user()->getUserRole(Auth::user()->id) == 'site_manager' || Auth::user()->getUserRole(Auth::user()->id) == 'super_admin')
							<li><a href="{{ url('/company_requests_list') }}">Company requests list</a></li>
							@endif
							@if(Auth::user()->getUserRole(Auth::user()->id) == 'site_manager' || Auth::user()->getUserRole(Auth::user()->id) == 'super_admin' || Auth::user()->getUserRole(Auth::user()->id) == 'client')
							<li><a href="{{ url('/companies') }}">Companies</a></li>
							@endif
							@if(Auth::user()->getUserRole(Auth::user()->id) == 'super_admin')
							<li><a href="{{ url('/users') }}">Users</a></li>
							@endif
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
									Projects <span class="caret"></span>
								</a>  
								<ul class="dropdown-menu" role="menu">
									<li> 
										<a href="{{ url('/projects') }}">
											Projects
										</a> 
									</li>
									<li>
										<a href="{{ url('/project_tasks') }}">
											Project tasks
										</a> 
									</li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
									{{ Auth::user()->name }} <span class="caret"></span>
								</a>

								<ul class="dropdown-menu" role="menu">
									<li>
										<a href="{{ url('/logout') }}"
											onclick="event.preventDefault();
													 document.getElementById('logout-form').submit();">
											Logout
										</a>

										<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
										</form>
									</li>
								</ul>
							</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		@yield('content')
	</div>

	<!-- Scripts -->
	<script src="/js/app.js"></script>
</body>
</html>
