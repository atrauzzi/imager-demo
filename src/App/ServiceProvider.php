<?php namespace App;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use App\ErrorHandler\Json as JsonErrorHandler;


class ServiceProvider extends BaseServiceProvider {

	/**
	 * Run during framework startup.
	 *
	 * @return void
	 */
	public function register() {

		// Binding for the JSON error handler.
		$this->app->bind('App\ErrorHandler\Json', function (Application $app) {
			return new JsonErrorHandler($app['translator'], $app['config']->get('app.debug', false));
		});

		$this->app->bind('App\Domain\Repository\Item', 'App\Domain\Repository\DbItem');

		// Supply the class names of commands you wish to run here.
		$this->commands([
		]);

	}

	/**
	 * Run at the start of every request.
	 */
	public function boot() {



	}

}