@extends('admin.layout')

@section('content')
<div id="content">


</div>

@stop

@section('templates')
<script type="text/template" id="users-template">
	<h3 id="page-title">Latest 100 users</h3>

	<div class="form-inline">
		<select name="filter-type" id="filter-type">
			<option value="Username">Username</option>
			<option value="Email">Email</option>
		</select>

		<input id="filter-query" class="filter" type="text" placeholder="Filter">
	</div>
	<div class="form-inline">
		<label for="only-banned" class="checkbox">
			<input id="only-banned" class="filter" type="checkbox"> Banned
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
			</tr>
		</thead>
	</table>
</script>

<script type="text/template" id="user-template">
	<td><%= id %></td>
	<td><%- username %></td>
	<td><%= email %></td>
	<td><%= activated %></td>
	<td><%= created_at %></td>
</script>
@stop

@section('scripts')

<script type="text/javascript">

new Classie.Router;
Backbone.history.start();

</script>

@stop