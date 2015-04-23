<?php

return [
	/*
	|--------------------------------------------------------------------------
	| 静态资源文件/上传文件访问路径URL设置
	|--------------------------------------------------------------------------
	*/
	'fileuse' => env('FILES_SERVICE','local'),
	'fileurl' => [
		//不使用任何服务配置
		'local' => [
			'static' => '',
			'uploads' => '/uploads',
		],

		//CDN配置
		'cdn' =>[
			'static' => 'http://static.pianke.me',
			'uploads' => 'http://upload.pianke.me',
			'api' => 'http://172.16.1.252:425/upload.php'
		],
	],

];
