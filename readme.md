## Classie

Open source classified ad software written in PHP.

### Requirements

* PHP >= 5.3.7
* MCrypt PHP Extension
* [Composer](http://getcomposer.org/)
* [Vagrant](http://www.vagrantup.com/) (for a development environment)

### Installing

These instructions are for a **development** install only. The project is **not** ready for a 
production environment.

    >vagrant up
    >vagrant ssh

    $ composer install --dev
    $ php artisan classie:install

An admin user is seeded at the moment so there is no need to create one unless you want to.

### License

Classie is open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT)
