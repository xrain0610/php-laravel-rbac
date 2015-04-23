<?php namespace Pianke\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model {

	//根据权限ID数组获取权限菜单数组
	public static function getCurPermissionArray(array $perids){
		//默认权限,不受授权系统限制的特殊权限
		$curpermissionroutes[] = '\Pianke\Http\Controllers\AdminHomeController@getIndex'; //首页
		$curpermissionroutes[] = '\Pianke\Http\Controllers\AdminHomeController@getProfile'; //修改资料
		$curpermissionroutes[] = '\Pianke\Http\Controllers\AdminHomeController@postProfile'; 
		$curpermissionroutes[] = '\Pianke\Http\Controllers\AdminHomeController@getChangepass'; //修改密码
		$curpermissionroutes[] = '\Pianke\Http\Controllers\AdminHomeController@postChangepass';
		$curpermissionroutes[] = '\Pianke\Http\Controllers\AdminHomeController@getUploadphoto'; //上传头像
		$curpermissionroutes[] = '\Pianke\Http\Controllers\AdminHomeController@postUploadphoto';
		$curpermissionroutes[] = '\Pianke\Http\Controllers\AdminHomeController@getNotice';//获取通知信息
		$curpermissionroutes[] = '\Pianke\Http\Controllers\AdminHomeController@getProcessNotice';//处理通知信息

		//权限处理流程
		$curpermissions = [];
		$permissions = AdminPermission::where('status','=','1')->orderBy('sort', 'asc')->get();
		foreach ($permissions as $value) {
			if($value->pid != 0 and (in_array($value->id, $perids) or $perids[0] == 'all')){
				if($value->menu == 1){
					$routes = explode("|", $value->route);
					$curpermissions[$value->pid]['list'][] = [
						'name' => trans($value->name),
						'route' => $routes[0],
					];
				}
				$curpermissionroutes = array_merge($curpermissionroutes,explode("|", $value->route));
			}
		}
		foreach ($permissions as $value) {
			if($value->pid == 0 and array_key_exists($value->id, $curpermissions)){
				$curpermissions[$value->id]['name'] = trans($value->name);
				$curpermissions[$value->id]['icon'] = $value->route;
				$curpermissions[$value->id]['sort'] = $value->sort;
			}
		}
		$curpermissions = \Tools::array_vsort($curpermissions,'sort');
		\Session::put('menu', $curpermissions);
		\Session::put('curpermissions', $curpermissionroutes);
		return $curpermissions;

	}

	//取得所有的权限并生成列表数组
	public static function getAllArray(){
		$permissions = AdminPermission::orderBy('sort', 'asc')->get();
		foreach ($permissions as $value) {
			if($value->pid != 0){
				$perlists[$value->pid]['list'][] = [
					'id' => $value->id,
					'name' => trans($value->name),
					'desc' => trans($value->desc),
					'status' => $value->status,
					'menu' => $value->menu,
				];
			}else{
				$perlists[$value->id]['name'] = trans($value->name);
				$perlists[$value->id]['sort'] = trans($value->sort);
			}
		}
		$perlists = \Tools::array_vsort($perlists,'sort');
		return $perlists;
	}

	//取得状态为可用的权限并生成列表
	public static function getActiveArray(){
		$permissions = AdminPermission::where('status','=','1')->orderBy('sort', 'asc')->get();
		foreach ($permissions as $value) {
			if($value->pid != 0){
				$perlists[$value->pid]['list'][] = [
					'id' => $value->id,
					'name' => trans($value->name),
					'desc' => trans($value->desc),
					'status' => $value->status,
					'menu' => $value->menu,
				];
			}else{
				$perlists[$value->id]['name'] = trans($value->name);
			}
		}
		return $perlists;
	}
}
