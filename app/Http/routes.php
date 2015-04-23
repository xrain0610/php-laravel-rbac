<?php
//API接口路由
Route::group(['domain' => 'mapi.pianke.me','middleware' => 'api'], function(){
	Route::Controller('pub','ApiPubController');
});

//后台路由 admin.pianke.me
Route::group(['domain' => 'admin.pianke.me','middleware' => 'csrf'], function(){
	Route::Controller('auth','AdminLoginController');
	Route::group(['middleware' => 'adminauth'], function(){
		Route::get('/','AdminHomeController@getIndex');
		Route::Controller('home','AdminHomeController');
		Route::Controller('jing','AdminJingController');
		Route::Controller('system','AdminManagerController');
		Route::Controller('download','AdminDownloadController');
		Route::Controller('helper','AdminHelperController');
		Route::Controller('passport','AdminPassportController');
	});
});

//片刻new前台
Route::group(['domain' => 'new.pianke.me','middleware' => 'csrf'], function(){
	Route::get('/','DownloadController@getApp');
	Route::get('/index','DefaultController@getIndex');
	Route::get('download','DownloadController@getDownload');
	Route::get('download/{str}','DownloadController@getDownload');
	Route::Controller('jing','JingController');
	Route::Controller('passport','PassportController');
});

