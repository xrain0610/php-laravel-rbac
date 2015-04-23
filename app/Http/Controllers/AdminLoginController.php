<?php namespace Pianke\Http\Controllers;

use Pianke\Http\Requests;
use Pianke\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminLoginController extends Controller {
	//后台登录页面
	public function getLogin(){
		if(\Session::has('adminlogin')){
			return redirect()->action('\Pianke\Http\Controllers\AdminHomeController@getIndex');
		}
		return view("admin.login");
	}

	//后台登录处理
	public function postLogin(){
		$u = \Pianke\Models\AdminUser::doLogin(\Request::input('username'),\Request::input('password'));
		if($u){
			\Session::put('adminlogin',$u);
			return redirect()->action('\Pianke\Http\Controllers\AdminHomeController@getIndex');
		}else{
			return redirect()->action('\Pianke\Http\Controllers\AdminLoginController@getLogin')->with('error',trans('admin.login_failed'));
		}
	}

	//退出后台登录
	public function getLogout(){
		\Session::forget('adminlogin');
		return redirect()->action('\Pianke\Http\Controllers\AdminLoginController@getLogin');
	}
}
