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

		$this->app->bind('Ortzinator\Classie\Repositories\PostingRepository',
			'Ortzinator\Classie\Repositories\PostingRepositoryEloquent');

		$this->app->bind('Ortzinator\Classie\Repositories\PagesRepository',
			'Ortzinator\Classie\Repositories\PagesRepositoryEloquent');

		$this->app->bind('Ortzinator\Classie\Repositories\CategoryRepository',
			'Ortzinator\Classie\Repositories\CategoryRepositoryEloquent');

		$this->app->bind('Ortzinator\Classie\Repositories\QuestionRepository',
			'Ortzinator\Classie\Repositories\QuestionRepositoryEloquent');
	}
}