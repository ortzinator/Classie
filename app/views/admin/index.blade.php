@extends('admin.layout')

@section('content')

<h3 id="page-title">Latest 100 users</h3>

<input id="filter" type="text" placeholder="User filter">

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

@stop

@section('templates')
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

var usersCollection = new Classie.Collections.Users;
usersCollection.fetch().then(function() {
	var usersView = new Classie.Views.UsersView({ collection: usersCollection });
	$('#userList').append(usersView.render().el);
});

</script>

@stop