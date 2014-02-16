# Laravel PHP Framework with configured package "laravel-modules"

## Official Laravel Documentation

Documentation for the entire framework can be found on the [Laravel website](http://laravel.com/docs).

### Contributing To Laravel

**All issues and pull requests should be filed on the [laravel/framework](http://github.com/laravel/framework) repository.**

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)


## Official laravel-modules Documentation

Documentation for the laravel-modules can be found on the [https://github.com/creolab/laravel-modules](https://github.com/creolab/laravel-modules).

## Configured directories

* "app/modules" moved to "/modules"
* "app/storage" moved to "/storage"

Use commands after cloning repository

Downloading packages:

	$ composer update

Update autoloading classes

	$ php artisan dump-autoload

Install migrations and seeding database for a modules:

	$ php artisan migrate
	$ php artisan modules:migrate --seed