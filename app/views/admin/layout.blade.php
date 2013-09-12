<!DOCTYPE html>
<html>
<head>
<title>
	{{{ Setting::get('classie.site_title') }}} 
	@if(isset($title))
		{{{ ' - ' . $title }}} 
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
					<li>{{ link_to_action('AdminSettingsController@getIndex', 'Settings') }}</li>
					<li>{{ link_to_action('AdminUserController@getIndex', 'Users') }}</li>
					<li>{{ link_to_action('AdminPostingController@getIndex', 'Postings') }}</li>
				</ul>

				<ul class="nav pull-right">
					@if(Sentry::check())
						<li>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-user"></i>
								{{{ Sentry::getUser()->username }}}
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li>{{ link_to('settings', 'settings') }}</li>
								@if($is_admin)
									<li>{{ link_to('admin', 'admin') }}</li>
								@endif
								<li>{{ link_to('auth/logout', 'log out') }}</li>
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
	<script src="{{ asset('js/jquery-1.8.2.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap-dropdown.js') }}"></script>
	<script src="{{ asset('js/markdown.js') }}"></script>
	<script src="{{ asset('js/classie.js') }}"></script>
</body>
</html>
