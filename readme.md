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

These instructions are for a **development** install only. The project is **not** ready for a 
production environment.

    >vagrant up
    >vagrant ssh

    $ composer install --dev
    $ php artisan classie:install

The Vagrant setup uses [rsync for folder syncing](https://docs.vagrantup.com/v2/synced-folders/rsync.html) This allows Classie to run much faster in the VM when Windows is the host OS. If you are on Linux or Mac it will be more convenient to use [NFS](https://docs.vagrantup.com/v2/synced-folders/nfs.html)

This means you must either run `vagrant rsync` or `vagrant rsync-auto` to sync files to the VM.

## License

Classie is open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT)
