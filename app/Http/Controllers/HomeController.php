<?php namespace RAD\Http\Controllers;

use Illuminate\Routing\Controller;
use Response;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphObject;
use Facebook\FacebookRequestException;


class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@index');
	|
	*/

	public function index()
	{
		FacebookSession::setDefaultApplication(getenv('FB_APP_ID'), getenv('FB_APP_SECRET'));
		$session = FacebookSession::newAppSession();
		
		$request = new FacebookRequest(
		  $session,
		  'GET',
		  '/373511866022579'
		);
		$response = $request->execute();
		$graphObject = $response->getGraphObject()->asArray();
	
		$group = $graphObject;


		$request = new FacebookRequest(
		  $session,
		  'GET',
		  '/373511866022579/feed'
		);
		$response = $request->execute();
		$graphObject = $response->getGraphObject()->asArray();
	
		$feed = $graphObject['data'];

		return view('hello', ['feed' => $feed, 'group' => $group]);
	}

}
