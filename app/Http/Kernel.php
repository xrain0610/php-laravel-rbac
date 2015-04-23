<?php namespace Pianke\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'userauth' => 'Pianke\Http\Middleware\UserAuth',
		'adminauth' => 'Pianke\Http\Middleware\AdminAuth',
		'api' => 'Pianke\Http\Middleware\ApiProcess',
		'csrf' => 'Pianke\Http\Middleware\VerifyCsrfToken',
	];

}
