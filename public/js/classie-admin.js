window.Classie = {
	Models: {},
	Collections: {},
	Views: {},
	Router: {}
};

window.vent = _.extend({}, Backbone.Events);

window.template = function(id) {
	return _.template($('#' + id).html());
};

Classie.Router = Backbone.Router.extend({
	routes: {
		'': 'dashboard',
		'users': 'users',
		'settings': 'settings',
		'postings': 'postings',
		'categories': 'categories'
	},

	users: function() {
		var usersCollection = new Classie.Collections.Users;
		usersCollection.fetch().then(function() {
			var usersView = new Classie.Views.UsersView({ collection: usersCollection });
			$('#content').html(usersView.render().el);
		});
	},

	settings: function() {
		console.log('settings');
	},


});


Classie.Models.User = Backbone.Model.extend({});

Classie.Collections.Users = Backbone.Collection.extend({
	model: Classie.Models.User,
	url: '/api/users'
});

Classie.Views.UserView = Backbone.View.extend({
	tagName: 'tr',

	template: template('user-template'),

	render: function() {
		this.$el.html(this.template(this.model.toJSON()));
		return this;
	}
});

Classie.Views.UsersView = Backbone.View.extend({
	template: template('users-template'),

	events: {
		'keyup .filter': 'search',
	},

	render: function() {
		this.listView = new Classie.Views.UserListView({ collection: this.collection });
		this.$el.html(this.template());
		this.$el.find('#userList').append(this.listView.render().el);
		return this;
	},

	search: function () {
		var key = $('#filter-query').val();
		if (event.keyCode == 13 || !key) {
			this.collection.fetch({ data: $.param({ 'username': key}), reset: true });
			console.log('search ' + key);
		}
	},
});

Classie.Views.UserListView = Backbone.View.extend({
	tagName: 'tbody',

	initialize: function () {
		this.collection.on('reset', this.render, this);
	},

	render: function(){
		this.$el.empty();
		this.collection.each(function(user){
			var userView = new Classie.Views.UserView({ model: user });
			this.$el.append(userView.render().el);
		}, this);

		return this;
	}
});

