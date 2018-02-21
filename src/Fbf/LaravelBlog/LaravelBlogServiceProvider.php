<?php namespace Fbf\LaravelBlog;

use Illuminate\Support\ServiceProvider;

class LaravelBlogServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->loadViewsFrom(__DIR__ . '/../../views', 'laravel-blog');
		$this->loadTranslationsFrom(__DIR__ . '/../../lang', 'laravel-blog');

		if (\Config::get('laravel-blog.routes.use_package_routes', true))
		{
			$this->loadRoutesFrom(__DIR__.'/../../routes.php');
		}

		$this->publishes([
			__DIR__ . '/../../config/images.php' => config_path('laravel-blog/images.php'),
			__DIR__ . '/../../config/link.php' => config_path('laravel-blog/link.php'),
			__DIR__ . '/../../config/meta.php' => config_path('laravel-blog/meta.php'),
			__DIR__ . '/../../config/routes.php' => config_path('laravel-blog/routes.php'),
			__DIR__ . '/../../config/seed.php' => config_path('laravel-blog/seed.php'),
			__DIR__ . '/../../config/views.php' => config_path('laravel-blog/views.php'),
			__DIR__ . '/../../config/you_tube.php' => config_path('laravel-blog/you_tube.php'),
		]);

		\App::register('Thujohn\Rss\RssServiceProvider');
		\App::register('Cviebrock\EloquentSluggable\ServiceProvider');

		// Shortcut so developers don't need to add an Alias in app/config/app.php
		$this->app->booting(function()
		{
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Fbf\LaravelBlog\Rss', 'Thujohn\Rss\RssFacade');
			$loader->alias('Sluggable', 'Cviebrock\EloquentSluggable\Facades\Sluggable');
		});

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}