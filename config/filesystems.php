<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Default Filesystem Disk
	|--------------------------------------------------------------------------
	| Supported: "local", "s3", "rackspace"
	*/

	'default' => 'local',

	/*
	|--------------------------------------------------------------------------
	| Default Cloud Filesystem Disk
	|--------------------------------------------------------------------------
	*/

	'cloud' => 'local',

	/*
	|--------------------------------------------------------------------------
	| Filesystem Disks
	|--------------------------------------------------------------------------
	*/

	'disks' => [

		'local' => [
			'driver' => 'local',
			'root'   => public_path().'/uploads',
		],

		'upyun' => [
			'driver' => 'upyun',
			'key'    => 'your-key',
			'secret' => 'your-secret',
			'region' => 'your-region',
			'bucket' => 'your-bucket',
		],

		's3' => [
			'driver' => 's3',
			'key'    => 'your-key',
			'secret' => 'your-secret',
			'region' => 'your-region',
			'bucket' => 'your-bucket',
		],

		'rackspace' => [
			'driver'    => 'rackspace',
			'username'  => 'your-username',
			'key'       => 'your-key',
			'container' => 'your-container',
			'endpoint'  => 'https://identity.api.rackspacecloud.com/v2.0/',
			'region'    => 'IAD',
			'url_type'  => 'publicURL'
		],

	],

];
