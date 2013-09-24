App = Ember.Application.create();

App.RESTAdapter = Ember.RESTAdapter.extend({
	buildURL: function(klass, id) {
		var urlRoot = Ember.get(klass, 'url');
		if (!urlRoot) { throw new Error('Ember.RESTAdapter requires a `url` property to be specified'); }

		if (!Ember.isEmpty(id)) {
			return urlRoot + "/" + id;
		} else {
			return urlRoot;
		}
	}
});

App.Router.map(function() {
	this.resource('users', function () {
		this.resource('user', { path: ':user_id' });
	});
});

App.UsersRoute = Ember.Route.extend({
	model: function() {
		//return $.getJSON('/api/users');
		return App.User.find();
	}
});

App.User = Ember.Model.extend({
	id: Ember.attr(),
	username: Ember.attr(),
	email: Ember.attr(),
	activated: Ember.attr(),
	created_at: Ember.attr()
});

App.User.adapter = App.RESTAdapter.create();
App.User.url = '/api/users';

App.UsersController = Ember.ArrayController.extend({
	filterText: null,
	filterTextSubmitted: null,
	onlyBanned: false,
	onlyBannedSubmitted: false,
	loading: false,

	changed: function () {
		var fa = this.get('filterText');
		var fb = this.get('filterTextSubmitted');
		var ba = this.get('onlyBanned');
		var bb = this.get('onlyBannedSubmitted');

		return !(fa === fb && ba === bb);
	}.property('filterText', 'onlyBanned', 'filterTextSubmitted', 'onlyBannedSubmitted'),

	actions: {
		filter: function () {
			var text = this.get('filterText');
			var onlyBanned = this.get('onlyBanned');

			this.set('loading', true);

			var self = this;
			App.User.fetch({ search: text, onlyBanned: onlyBanned }).then(function (data) {
				self.set('content', data);
				this.set('filterTextSubmitted', text);
				this.set('onlyBannedSubmitted', onlyBanned);
				this.set('loading', false);
			});

		}
	}
});

// App.UserRoute = Ember.Route.extend({
// 	model: function(params) {
// 		return users.findBy('id', params.post_id);
// 	}
// });


// App.UserController = Ember.ObjectController.extend({
// 	isEditing: false,

// 	actions: {
// 		edit: function() {
// 			this.set('isEditing', true);
// 		},

// 		doneEditing: function() {
// 			this.set('isEditing', false);
// 		}
// 	}
// });

// App.User.FIXTURES = [
// 	{
// 		"id": "10",
// 		"email": "test8@test.org",
// 		"permissions": [],
// 		"activated": true,
// 		"activated_at": "2013-08-25 19:30:16",
// 		"last_login": "2013-08-25 19:30:16",
// 		"created_at": "2013-08-25 19:30:16",
// 		"updated_at": "2013-08-25 19:30:17",
// 		"username": "Roober",
// 		"first_name": null,
// 		"last_name": null,
// 		"name": null
// 	},
// 	{
// 		"id": "9",
// 		"email": "test6@test.org",
// 		"permissions": [],
// 		"activated": true,
// 		"activated_at": "2013-08-25 19:23:18",
// 		"last_login": null,
// 		"created_at": "2013-08-25 19:23:18",
// 		"updated_at": "2013-08-25 19:23:18",
// 		"username": "Floober",
// 		"first_name": null,
// 		"last_name": null,
// 		"name": null
// 	},
// 	{
// 		"id": "8",
// 		"email": "test5@test.org",
// 		"permissions": [],
// 		"activated": true,
// 		"activated_at": "2013-08-25 04:46:02",
// 		"last_login": null,
// 		"created_at": "2013-08-25 04:46:02",
// 		"updated_at": "2013-08-25 04:46:02",
// 		"username": "Doober",
// 		"first_name": null,
// 		"last_name": null,
// 		"name": null
// 	},
// 	{
// 		"id": "7",
// 		"email": "test4@test.org",
// 		"permissions": [],
// 		"activated": true,
// 		"activated_at": "2013-08-25 03:28:39",
// 		"last_login": null,
// 		"created_at": "2013-08-25 03:28:39",
// 		"updated_at": "2013-08-25 03:28:39",
// 		"username": null,
// 		"first_name": null,
// 		"last_name": null,
// 		"name": null
// 	},
// 	{
// 		"id": "6",
// 		"email": "test3@test.org",
// 		"permissions": [],
// 		"activated": true,
// 		"activated_at": "2013-08-25 03:24:47",
// 		"last_login": null,
// 		"created_at": "2013-08-25 03:24:47",
// 		"updated_at": "2013-08-25 03:24:47",
// 		"username": null,
// 		"first_name": null,
// 		"last_name": null,
// 		"name": null
// 	},
// 	{
// 		"id": "5",
// 		"email": "test2@test.org",
// 		"permissions": [],
// 		"activated": true,
// 		"activated_at": "2013-08-25 03:15:39",
// 		"last_login": null,
// 		"created_at": "2013-08-25 03:15:39",
// 		"updated_at": "2013-08-25 03:15:39",
// 		"username": null,
// 		"first_name": null,
// 		"last_name": null,
// 		"name": null
// 	},
// 	{
// 		"id": "4",
// 		"email": "test@test.org",
// 		"permissions": [],
// 		"activated": false,
// 		"activated_at": null,
// 		"last_login": null,
// 		"created_at": "2013-08-24 17:15:59",
// 		"updated_at": "2013-08-24 17:15:59",
// 		"username": null,
// 		"first_name": null,
// 		"last_name": null,
// 		"name": null
// 	},
// 	{
// 		"id": "3",
// 		"email": "ortzinator@gmail.com",
// 		"permissions": [],
// 		"activated": false,
// 		"activated_at": null,
// 		"last_login": null,
// 		"created_at": "2013-08-06 03:35:08",
// 		"updated_at": "2013-08-06 03:35:09",
// 		"username": null,
// 		"first_name": null,
// 		"last_name": null,
// 		"name": null
// 	},
// 	{
// 		"id": "1",
// 		"email": "admin@admin.com",
// 		"permissions": [],
// 		"activated": true,
// 		"activated_at": null,
// 		"last_login": "2013-09-20 17:58:42",
// 		"created_at": "2013-07-28 02:52:59",
// 		"updated_at": "2013-09-20 17:58:42",
// 		"username": "JClane",
// 		"first_name": null,
// 		"last_name": null,
// 		"name": "John McClane"
// 	},
// 	{
// 		"id": "2",
// 		"email": "test1@test.com",
// 		"permissions": [],
// 		"activated": true,
// 		"activated_at": null,
// 		"last_login": null,
// 		"created_at": "2013-07-28 02:52:59",
// 		"updated_at": "2013-07-28 02:52:59",
// 		"username": "JFeld",
// 		"first_name": null,
// 		"last_name": null,
// 		"name": null
// 	}
// ];