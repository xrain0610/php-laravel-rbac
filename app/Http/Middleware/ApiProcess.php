<?php namespace Pianke\Http\Middleware;

use Closure;

class ApiProcess {

	public function handle($request, Closure $next)
	{
		//Check query method
		if (!\Request::isMethod('post')) {
			echo "Pianke Application Server - Powered by Pianke";
			exit;
		}

		//Create response array
		$input = \Request::input();
		$ret = [
			'ecode' => 0,
			'message' => trans('api.success'),
			'result' => [],
			'counter' => false,
		];
		\Session::set('ret_data',$ret);

		//Must input params
		$needparam = [
			'device_id',		//Device id
			'client_type',		//Android or iOS
			'version',			//Application version
			'timestamp',		//Query time
			'query',			//Query detiles
			'counter',			//Application counter

		];

		//Check params
		if(!\Tools::apiParam($needparam,\Request::input())){
			$ret = \Tools::apiErr('SE10000');
			return response()->json($ret);
		}

		//Process Counter
		if(\Request::input('counter')){
			$ret['counter'] = true;
		}

		//Set data for request
		return $next($request);
	}

}
