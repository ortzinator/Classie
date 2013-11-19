<!DOCTYPE html>
<html>
<head>
<title>
	{{{ Setting::get('classie.site_title') }}} 
	@if(isset($pageTitle))
		{{{ ' - ' . $pageTitle }}} 
	@endif
</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/markitup.css') }}" />
<style type="text/css">
	div#welcome {
		background-image: url({{ asset('images/fay.jpg') }});
	}
</style>
</head>

<body>
	<div id="topper" class="navbar" data-dropdown="dropdown">
		<div class="navbar-inner">
			<div class="container">

				{{ link_to_route('home', Setting::get('classie.site_title'), 
					NULL, ['class' => 'brand']) }}

				<ul class="nav">
					@if(Sentry::check())
						<li>{{ link_to_route('posting.create', 'post classified', NULL, ['class' => 'highlight']) }}</li>
					@endif
					
					@foreach($pages as $page)
						<li>{{ link_to('pages/' . $page->name, $page->name); }}</li>
					@endforeach
					<li class="dropdown">
						<a class="dropdown-toggle" href="#" data-toggle="dropdown">
							categories <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							@foreach($categories as $row)
								<li class="{{ ($row->parent_id != NULL) ? 'subcategory' : 'category' }}">
									{{ link_to_route('category', $row->name, 
									[$row->id, rawurlencode($row->short_name)]) }}</li>
							@endforeach
						</ul>
					</li>
				</ul>

				{{ Form::open(['url' => 'search', 'class' => 'navbar-search']) }}
				<input name="query" type="text" placeholder="search" class="search-query"
					value="{{ (isset($query)) ? $query : '' }}">
				{{ Form::close() }}

				<ul class="nav pull-right">
					@if(Sentry::check())
						<li>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-user"></i>
								{{{ Sentry::getUser()->username }}}
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="{{ url('settings') }}">
										<i class="icon-wrench"></i> settings
									</a>
								</li>
								@if($is_admin)
									<li>
										<a href="{{ url('admin') }}">
											<i class="icon-cog"></i> admin
										</a>
									</li>
								@endif
								<li>
									<a href="{{ url('auth/logout') }}">
										<i class="icon-off"></i> logout
									</a>
								</li>
							</ul>
						</li>
					@else
						<li>{{ link_to('auth/login', 'log in') }}</li>
						<li>{{ link_to('auth/register', 'register') }}</li>
					@endif
				</ul>

				</div>
			</div>
		</div>
	<div id="wrapper" class="container">
		<noscript>
			<div class="alert alert-error">
				Javascript is disabled. This site will not function correctly.
			</div>
		</noscript>
		<div id="notifications">
			@if(Session::has('alert-info'))
				<div class="alert alert-info">{{{ Session::get('alert-info') }}}</div>
			@endif
			@if(Session::has('alert-warning'))
				<div class="alert">{{{ Session::get('alert-warning') }}}</div>
			@endif
			@if(Session::has('alert-error'))
				<div class="alert alert-error">{{{ Session::get('alert-error') }}}</div>
			@endif
			@if(Session::has('alert-success'))
				<div class="alert alert-success">{{{ Session::get('alert-success') }}}</div>
			@endif
		</div>
		<div id="content">
			@yield('content')
		</div>
	</div>
	<footer>
		<div class="container">
			<span class="copyright">Copyright Brian Ortiz</span> <span class="separator">|</span>
			<span>License: MIT</span> <span class="separator">|</span>
			@if(App::environment() == "dev")
				<span>Development</span>
			@endif
		</div>
	</footer>
	<script src="{{ asset('js/jquery-1.8.2.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap/bootstrap-dropdown.js') }}"></script>
	<script src="{{ asset('js/markdown.js') }}"></script>
	<script src="{{ asset('js/classie.js') }}"></script>
</body>
</html>
