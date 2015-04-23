<?php namespace Pianke\Http\Controllers;

use Pianke\Http\Requests;
use Pianke\Http\Controllers\Controller;

use Illuminate\Http\Request;

class JingController extends Controller {

	//静静网页版
	public function getPlay(){ 
		if(\Request::input('id')){
			$id = \Request::input('id');
		}else{
			$id = \Cache::get('jing_lastest');
		}
		if(\Session::get('jing_open_token') != date('Ymd')) {
			\Session::put('jing_open_token', date('Ymd'));
			\Redis::connection('counter')->INCR('jing_counter_3_'.date('Ymd'));
			\Redis::connection('counter')->INCR('jing_counter_3_id_'.$id);
		}
		$info = \Pianke\Models\Jing::getById($id);
		return view('main.jing_play',['data'=>$info]);
	}

}
