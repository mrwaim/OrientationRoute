<?php namespace Klsandbox\OrientationRoute;

use Illuminate\Support\ServiceProvider;

class OrientationRouteServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

	public function boot() {
		if (!$this->app->routesAreCached()) {
			require __DIR__ . '/../../../routes/routes.php';
		}

		$this->loadViewsFrom(__DIR__ . '/../../../views/', 'orientation-route');

		$this->publishes([
			__DIR__ . '/../../../views/' => base_path('resources/views/vendor/orientation-route')
		], 'views');

		$this->publishes([
			__DIR__ . '/../../../database/migrations/' => database_path('/migrations')
		], 'migrations');
	}
}
