<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Default Cache Store
	|--------------------------------------------------------------------------
	*/

	'default' => env('CACHE_DRIVER', 'file'),

	/*
	|--------------------------------------------------------------------------
	| Cache Stores
	|--------------------------------------------------------------------------
	*/

	'stores' => [

		'apc' => [
			'driver' => 'apc'
		],

		'array' => [
			'driver' => 'array'
		],

		'file' => [
			'driver' => 'file',
			'path'   => storage_path().'/framework/cache',
		],

		'memcached' => [
			'driver'  => 'memcached',
			'servers' => [
				[
					'host' => env('MEMCACHED_HOST'), 
					'port' => env('MEMCACHED_PORT'), 
					'weight' => 100
				],
			],
		],

		'redis' => [
			'driver' => 'redis',
			'connection' => 'default',
		],

	],

	/*
	|--------------------------------------------------------------------------
	| Cache Key Prefix
	|--------------------------------------------------------------------------
	*/

	'prefix' => 'pianke',

];
