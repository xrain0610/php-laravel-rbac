<?php namespace Pianke\Http\Controllers;

use Pianke\Http\Requests;
use Pianke\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DownloadController extends Controller {

	public function getDownload($str = 'default'){
		$redis = \Redis::connection('counter');
		$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(strpos($agent, 'iphone') || strpos($agent, 'ipad')){
			if(!\Request::cookie('download_ident')){
				$redis->INCR('download_ios_all'); //IOS所有下载
				$redis->INCR('download_ios_'.$str.'_all');  //某个标识IOS所有下载
				$redis->INCR('download_ios_'.$str."_".date('Ymd')); // 某个标识某天IOS所有下载
				$redis->INCR('download_ios_'.date('Ymd')); // 某个标识某天IOS所有下载
				cookie('download_ident', true, 30);
			}
			return redirect('https://itunes.apple.com/cn/app/pian-ke/id791086961?mt=8');
		}
		if(strpos($agent, 'android')){
			if(!\Request::cookie('download_ident')){
				$redis->INCR('download_android_all');
				$redis->INCR('download_android_'.$str.'_all');
				$redis->INCR('download_android_'.$str."_".date('Ymd')); 
				$redis->INCR('download_android_'.date('Ymd')); 
				cookie('download_ident', true, 30);
			}
			return redirect('http://www.wandoujia.com/apps/com.pianke.client');
		}
		return redirect('http://pianke.me');
	}

	public function getApp(){
		return view('main.app_guide',['nofooter'=>1]);
	}
}