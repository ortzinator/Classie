<!DOCTYPE html>
<html>
<head>
<title>
	<?php print Setting::get('classie.site_title'); ?>
	<?php if(isset($title)): ?>
		<?php print ' - ' . $title; ?>
	<?php endif; ?>
</title>
<link rel="stylesheet" type="text/css" href="<?php print asset('css/bootstrap/bootstrap.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php print asset('css/main.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php print asset('css/markitup.css'); ?>" />
<style type="text/css">
	div#welcome {
		background-image: url(<?php print asset('images/fay.jpg'); ?> );
	}
</style>
</head>

<body>
<script type="text/x-handlebars">
	<div id="topper" class="navbar" data-dropdown="dropdown">
		<div class="navbar-inner">
			<div class="container">

				<?php print link_to_route('home', Setting::get('classie.site_title'), 
					NULL, ['class' => 'brand']); ?>

				<ul class="nav" id="admin-nav">
					<li>{{#link-to 'users'}}Users{{/link-to}}</li>
					<li>{{#link-to 'settings'}}Settings{{/link-to}}</li>
				</ul>

				<ul class="nav pull-right">
					<?php if(Sentry::check()): ?>
						<li>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-user"></i>
								<?php print Sentry::getUser()->username; ?>
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><?php print link_to('settings', 'settings'); ?></li>
								<?php if($is_admin): ?>
									<li><?php print link_to('admin', 'admin'); ?></li>
								<?php endif; ?>
								<li><?php print link_to('auth/logout', 'log out'); ?></li>
							</ul>
						</li>
					<?php else: ?>
						<li><?php print link_to('auth/login', 'log in'); ?></li>
						<li><?php print link_to('auth/register', 'register'); ?></li>
					<?php endif; ?>
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
			<?php if(Session::has('alert-info')): ?>
				<div class="alert alert-info"><?php print Session::get('alert-info'); ?></div>
			<?php endif; ?>
			<?php if(Session::has('alert-warning')): ?>
				<div class="alert"><?php print Session::get('alert-warning'); ?></div>
			<?php endif; ?>
			<?php if(Session::has('alert-error')): ?>
				<div class="alert alert-error"><?php print Session::get('alert-error'); ?></div>
			<?php endif; ?>
			<?php if(Session::has('alert-success')): ?>
				<div class="alert alert-success"><?php print Session::get('alert-success'); ?></div>
			<?php endif; ?>
		</div>
		<div id="content">
			{{outlet}}
		</div>
	</div>
</script>

<script type="text/x-handlebars" id="users">
	<h3 id="page-title">Latest 100 users</h3>
	<div class="form-inline">
		{{input type="text" name="filter-query" placeholder="Filter" action="filter" 
			valueBinding="filterText"}}
		{{#if changed}}
			<button {{action 'filter'}}>Filter</button>
		{{/if}}
	</div>
	<div class="form-inline">
		<label for="onlyBanned" class="checkbox">
			{{input type="checkbox" checked=onlyBanned}} Banned
		</label>
	</div>

	<table id="userList" class="table table-striped">
		<thead>
			<tr>
				<th>Id</th>
				<th>Username</th>
				<th>Email</th>
				<th>Activated</th>
				<th>Join Date</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		{{#each content}}
			<tr>
				<td>{{id}}</td>
				<td>{{username}}</td>
				<td>{{email}}</td>
				<td>{{activated}}</td>
				<td>{{created_at}}</td>
				<td>
					<div class="buttons">
						<button class="btn btn-mini btn-link" type="button" hidden="hidden">Edit</button>
						<button class="btn btn-mini btn-danger" type="button" hidden="hidden">
							<i class="icon-ban-circle icon-white"></i> Ban</button>
					</div>
				</td>
			</tr>
		{{/each}}
		</tbody>
	</table>
		{{#unless content}}
			<p class="alert">No users found</p>
		{{/unless}}
</script>

<script type="text/x-handlebars" id="user">
	
</script>

<script type="text/x-handlebars" id="settings">
	<form class="form-horizontal" {{action "save" on="submit"}}>
	{{#if saveFailed}}
		<div class="alert">Settings failed to save</div>
	{{/if}}
	<fieldset>
		<legend>Settings</legend>
		<div class="control-group">
			<label for="site_title" class="control-label">Title</label>
			<div class="controls">
				{{input name="site_title" value=site_title class="span5"}}
			</div>
		</div>

		<div class="control-group">
			<label for="site_description_long" class="control-label">Description</label>
			<div class="controls">
				{{textarea name="site_description_long" value=site_description_long class="span5"}}
			</div>
		</div>

		<div class="control-group">
			<label for="site_description_short" class="control-label">Short description</label>
			<div class="controls">
				{{input name="site_description_short" value=site_description_short class="span5"}}
			</div>
		</div>

		<div class="controls">
			<button type="submit" class="btn btn-primary" {{bindAttr disabled="isSaving"}}>Save</button>
		</div>
	</fieldset>
	</form>
</script>

	<script src="<?php print asset('js/jquery-1.8.2.min.js'); ?>"></script>
	<script src="<?php print asset('js/bootstrap/bootstrap-dropdown.js'); ?>"></script>
	<script src="<?php print asset('js/markdown.js'); ?>"></script>
	<script src="<?php print asset('js/handlebars-1.0.0.js'); ?>"></script>
	<script src="<?php print asset('js/ember.js'); ?>"></script>
	<script src="<?php print asset('js/ember-model.js'); ?>"></script>
	<script src="<?php print asset('js/classie.js'); ?>"></script>
	<script src="<?php print asset('js/classie-admin.js'); ?>"></script>

</body>
</html>
