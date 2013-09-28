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
	this.resource('settings');
});

App.UsersRoute = Ember.Route.extend({
	model: function() {
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

App.SettingsRoute = Ember.Route.extend({
	model: function() {
		return App.Settings.find(1);
	}
});

App.Settings = Ember.Model.extend({
	site_title: Ember.attr(),
	site_description_long: Ember.attr(),
	site_description_short: Ember.attr()
});

App.Settings.adapter = App.RESTAdapter.create();
App.Settings.url = '/api/settings';

App.SettingsController = Ember.ObjectController.extend({
	saveFailed: false,
	isSaving: false,

	actions: {
		save: function () {
			var model = this.get('model');

			var self = this;
			self.set('isSaving', true);
			model.save().then(function (model) {
				console.log('saved');
				self.set('isSaving', false);
				self.set('saveFailed', false);
			}, function (data) {
				var response = $.parseJSON(data.responseText);
				self.set('saveFailed', true);
				self.set('isSaving', false);
				console.log(response.message);
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
