<?php namespace Pianke\Http\Controllers;

use Pianke\Http\Requests;
use Pianke\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PassportController extends Controller {
	//用户许可协议
	public function getRegisterAgreement(){
		return view('main.register_agreement');
	}

	//注册完毕发送邮件提示
	public function getRegmail(){
		\Session::reflash();
		return view('main.register_sendmail');
	}

	//用户注册页面
	public function getRegister(){
		return view('main.register');
	}

	//注册处理
	public function postRegister(Request $request){
		$this->validate($request,[
			'email' => 'required|email|unique:users',
			'password' => 'required|min:6',
			'agreement' => 'accepted',
		]);
		$user = new \Pianke\Models\User;
		$user->email = \Request::input('email');
		$user->password = bcrypt(md5(\Request::input('password')));
		if($user->save()){
			return redirect()->action('\Pianke\Http\Controllers\PassportController@getRegmail')->withEmail(\Request::input('email'));
		}else{
			return redirect()->action('\Pianke\Http\Controllers\PassportController@getRegister')->with('error',trans('admin.reg_faild'));
		}
	}

	//用户邮件确认
	public function getEmailVerify(){
		if(!\Request::input('key')){abort(404);}
		$info = \Pianke\Models\UserEmailVerify::where('key','=',\Request::input('key'))->first();
		if(!$info){abort(404);}
		$user = \Pianke\Models\User::find($info->uid);
		if($user->email==$info->email and $info->status==0){
			$info->status=1;
			if($info->save()){
				return redirect()->action('\Pianke\Http\Controllers\PassportController@getRegister')->withError(trans('passport.emailverifyok'));
			}else{
				abort(500);
			}
		}else{
			return redirect()->action('\Pianke\Http\Controllers\PassportController@getRegister')->withError(trans('passport.emailverifyno'));
		}

	}

	//登录页面
	public function getLogin(){
		if(\Auth::check()){
			if(\Request::input('s')){
				return redirect(\Request::input('s'));
			}else{
				return redirect()->action('\Pianke\Http\Controllers\DefaultController@getIndex');
			}
		}
		return view('main.login');
	}

	//登录处理
	public function postLogin(){
		if (\Auth::attempt(['email' => \Request::input('email'), 'password' => md5(\Request::input('password'))])){
			if(\Request::input('s')){
				return redirect(\Request::input('s'));
			}else{
				return redirect()->action('\Pianke\Http\Controllers\DefaultController@getIndex');
			}
		}else{
			return redirect()->action('\Pianke\Http\Controllers\PassportController@getLogin')->withError(trans('passport.loginfailed'));
		}
	}

	//退出登录
	public function getLogout(){
		\Auth::logout();
		return redirect()->action('\Pianke\Http\Controllers\DefaultController@getIndex');
	}

}
