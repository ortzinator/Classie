<?php namespace Ortzinator\Classie;

use Illuminate\Support\ServiceProvider;

class ClassieServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->commands(
			'classie::install'
		);

		$this->app['classie::install'] = $this->app->share(function($app)
		{
			return new Console\InstallCommand($app['files'], $app['config']);
		});
	}

}