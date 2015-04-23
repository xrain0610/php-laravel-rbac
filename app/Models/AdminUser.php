<?php namespace Pianke\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model {
	//获取用户的角色模型关联
	public function role(){
		return $this->belongsTo('\Pianke\Models\AdminRole','roleid','id');
	}

	//登录信息检测 返回UID
	public static function doLogin($acct,$pass){
		$user_tmp = AdminUser::where("username","=",$acct)->where('status','=',true)->first();
		if(!$user_tmp){
			return false;
		}else{
			if (\Hash::check($pass, $user_tmp['password'])){
				return $user_tmp;
			}else{
				return false;
			}
		}
	}

}
