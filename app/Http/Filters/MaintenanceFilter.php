<?php namespace RAD\Http\Filters;

use App, Response;

class MaintenanceFilter {

	/**
	 * Run the request filter.
	 *
	 * @return mixed
	 */
	public function filter()
	{
		if (App::isDownForMaintenance())
		{
			return Response::make('Be right back!');
		}
	}

}