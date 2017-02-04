<?php

namespace Zix\Core\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class AssetsServiceProvider
 * @package Zix\Core\Providers
 */
class AssetsServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerViews();
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Register config.
	 *
	 * @return void
	 */
	protected function registerConfig()
	{
		$this->publishes([
			__DIR__.'/../Config/config.php' => config_path('core.php'),
		]);
		$this->mergeConfigFrom(
			__DIR__.'/../Config/config.php', 'core'
		);
	}

	/**
	 *
     */
	public function registerViews()
	{
		$viewPath = base_path('views/modules/core');

		$sourcePath = __DIR__.'/../Resources/views';

		$this->publishes([
			$sourcePath => $viewPath
		]);

		$this->loadViewsFrom([$viewPath, $sourcePath], 'core');
	}

	/**
	 * Register translations.
	 *
	 * @return void
	 */
	public function registerTranslations()
	{
		$langPath = base_path('resources/lang/modules/core');

		if (is_dir($langPath)) {
			$this->loadTranslationsFrom($langPath, 'core');
		} else {
			$this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'core');
		}
	}

}
