<?php namespace RAD\Providers;

use Illuminate\Routing\FilterServiceProvider as ServiceProvider;

class FilterServiceProvider extends ServiceProvider {

	/**
	 * The filters that should run before all requests.
	 *
	 * @var array
	 */
	protected $before = [
		'RAD\Http\Filters\MaintenanceFilter',
	];

	/**
	 * The filters that should run after all requests.
	 *
	 * @var array
	 */
	protected $after = [
		//
	];

	/**
	 * All available route filters.
	 *
	 * @var array
	 */
	protected $filters = [
		'auth' => 'RAD\Http\Filters\AuthFilter',
		'auth.basic' => 'RAD\Http\Filters\BasicAuthFilter',
		'csrf' => 'RAD\Http\Filters\CsrfFilter',
		'guest' => 'RAD\Http\Filters\GuestFilter',
	];

}