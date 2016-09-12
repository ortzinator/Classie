# Classie

Open source classified ad software written in PHP and using the [Laravel](http://laravel.com/) framework.

## Requirements

* PHP >= 5.3.7
* MCrypt PHP Extension
* [Composer](http://getcomposer.org/)

### Development Requirements

* [Vagrant](http://www.vagrantup.com/) >= 1.5
* (If on Windows) Cygwin with rsync installed

## Installing

These instructions are for a **development** install only. The is **not** a stable release.

    >vagrant up
    >vagrant ssh

    $ composer install
    $ php artisan classie:install

This means you must either run `vagrant rsync` or `vagrant rsync-auto` to sync files to the VM.

## License

Classie is open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT)
