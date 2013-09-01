<?php
$admin = Sentry::getGroupProvider()->findByName('Admin');
$is_admin = Sentry::check() && Sentry::getUser()->inGroup($admin);
?>
<!DOCTYPE html>
<html>
<head>
<title>
	{{{ Config::get('classie.site_title') }}} 
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

				{{ link_to_route('home', Config::get('classie.site_title'), 
					NULL, ['class' => 'brand']) }}

				<ul class="nav">
					@if(Sentry::check())
						<li>{{ link_to('post', 'post classified', ['class' => 'highlight']) }}</li>
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
								<li>{{ link_to_route('category', $row->name, 
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
