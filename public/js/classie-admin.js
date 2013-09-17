window.Classie = {
	Models: {},
	Collections: {},
	Views: {},
	Router: {}
};

window.template = function(id) {
	return _.template($('#' + id).html());
};

Classie.Router = Backbone.Router.extend({
	routes: {
		'': 'index'
	},

	index: function() {
		console.log( 'the index page' );
	}
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
	tagName: 'tbody',

	render: function(){
		this.collection.each(function(user){
			var userView = new Classie.Views.UserView({ model: user });
			this.$el.append(userView.render().el);
		}, this);

		return this;
	}
});

