<?php

return [

	/*
	|--------------------------------------------------------------------------
	| PDO Fetch Style
	|--------------------------------------------------------------------------
	*/

	'fetch' => PDO::FETCH_CLASS,

	/*
	|--------------------------------------------------------------------------
	| Default Database Connection Name
	|--------------------------------------------------------------------------
	*/

	'default' => env('DB_TYPE', 'pgsql'),

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	*/

	'connections' => [

		'pgsql' => [
			'driver'   => 'pgsql',
			'host'     => env('DB_HOST', 'localhost'),
			'database' => env('DB_DATABASE', 'forge'),
			'username' => env('DB_USERNAME', 'forge'),
			'password' => env('DB_PASSWORD', ''),
			'charset'  => 'utf8',
			'prefix'   => '',
			'schema'   => 'public',
		],

		'mysql' => [
			'driver'    => 'mysql',
			'host'      => env('DB_HOST', 'localhost'),
			'database'  => env('DB_DATABASE', 'forge'),
			'username'  => env('DB_USERNAME', 'forge'),
			'password'  => env('DB_PASSWORD', ''),
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
			'strict'    => false,
		],

	],

	/*
	|--------------------------------------------------------------------------
	| Migration Repository Table
	|--------------------------------------------------------------------------
	*/

	'migrations' => 'migrations',

	/*
	|--------------------------------------------------------------------------
	| Redis Databases
	|--------------------------------------------------------------------------
	*/

	'redis' => [

		'cluster' => false,
		//For Temp Use
		'default' => [
			'host'     => env('REDIS_HOST'),
			'port'     => env('REDIS_PORT'),
			'password' => env('REDIS_PASS'),
			'database' => 0,
		],
		//For Queue List
		'queue' => [
			'host'     => env('REDIS_HOST'),
			'port'     => env('REDIS_PORT'),
			'password' => env('REDIS_PASS',''),
			'database' => 1,
		],
		//For Counter
		'counter' => [
			'host'     => env('REDIS_HOST'),
			'port'     => env('REDIS_PORT'),
			'password' => env('REDIS_PASS'),
			'database' => 2,
		],

		//For Session
		'session' => [
			'host'     => env('REDIS_HOST'),
			'port'     => env('REDIS_PORT'),
			'password' => env('REDIS_PASS'),
			'database' => 3,
		],

		//For Notice
		'notice' => [
			'host'     => env('REDIS_HOST'),
			'port'     => env('REDIS_PORT'),
			'password' => env('REDIS_PASS'),
			'database' => 4,
		],

	],

];
