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
<link rel="stylesheet/less" type="text/css" href="{{ asset('css/bootstrap/bootstrap.less') }}" />
<link rel="stylesheet/less" type="text/css" href="{{ asset('css/main.less') }}" />
<link rel="stylesheet/less" type="text/css" href="{{ asset('css/markitup.less') }}" />
<script src="{{ asset('js/less-1.4.1.min.js') }}"></script>
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
					NULL, array('class' => 'brand')) }}

				<ul class="nav">
					@if(Sentry::check())
						<li>{{ link_to('post', 'post classified', 'class="highlight"'); }}</li>
					@endif
					<li>{{ link_to('about', 'about'); }}</li>
					<li class="dropdown">
						<a class="dropdown-toggle" href="#" data-toggle="dropdown">
							categories <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							@foreach($categories as $row)
								<li>{{ link_to_route('category', $row->name, 
									array($row->id, rawurlencode($row->short_name))) }}</li>
							@endforeach
						</ul>
					</li>
				</ul>

				{{ Form::open(array('url' => 'classifieds/search_form', 
					'class' => 'navbar-search')) }}
				<input name="query" type="text" placeholder="search" class="search-query">
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
		<div id="content">
			@yield('content')
		</div>
	</div>
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script src="{{ asset('js/bootstrap-dropdown.js') }}"></script>
	<script src="{{ asset('js/bootstrap-tooltip.js') }}"></script>
	<script src="{{ asset('js/markitup/set.markitup.js') }}"></script>
	<script src="{{ asset('js/markitup/jquery.markitup.js') }}"></script>
	<script src="{{ asset('js/Markdown.Converter.js') }}"></script>
	<script src="{{ asset('js/classie.js') }}"></script>
</body>
</html>
