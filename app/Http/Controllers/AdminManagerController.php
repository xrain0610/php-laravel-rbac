<?php namespace Pianke\Http\Controllers;

use Pianke\Http\Requests;
use Pianke\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminManagerController extends Controller {

	//权限列表
	public function getPermission(){
		$list = \Pianke\Models\AdminPermission::getAllArray();
		return view('admin.permission_lists',['list'=>$list]);	
	}

	//权限是否在菜单中显示
	public function getPermenu(){
		$id = \Request::input('id');
		$i = \Request::input('i')=='1'?0:1;
		$perinfo = \Pianke\Models\AdminPermission::find($id);
		if($perinfo){
			$perinfo->menu=$i;
			$perinfo->save();
			return redirect()->action('\Pianke\Http\Controllers\AdminManagerController@getPermission')->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
		}else{
			return redirect()->action('\Pianke\Http\Controllers\AdminManagerController@getPermission')->withNotice(['type'=>'error','msg'=>trans('admin.acterror'),'title'=>trans('admin.actfailed')]);
		}
		
	}

	//权限禁用和启用
	public function getPeract(){
		$id = \Request::input('id');
		$s = \Request::input('s')=='1'?0:1;
		$perinfo = \Pianke\Models\AdminPermission::find($id);
		if($perinfo and $id != '10'){
			$perinfo->status=$s;
			$perinfo->save();
			return redirect()->action('\Pianke\Http\Controllers\AdminManagerController@getPermission')->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
		}else{
			return redirect()->action('\Pianke\Http\Controllers\AdminManagerController@getPermission')->withNotice(['type'=>'error','msg'=>trans('admin.acterror'),'title'=>trans('admin.actfailed')]);
		}
	}

	//用户列表显示
	public function getUserlist(){
		$u = \Pianke\Models\AdminUser::all()->sortBy('id');
		return view('admin.user_list',['list'=>$u]);
	}

	//添加新用户
	public function getUseradd(){
		$roles = \Pianke\Models\AdminRole::all();
		return view('admin.user_add',['roles'=>$roles]);
	}

	public function postUseradd(Request $request){
		$this->validate($request, [
	        'username' => 'required|unique:admin_users,username',
	        'name' => 'required',
	        'password' => 'required',
	        'email' => 'required|email',
	        'cell' => 'required|numeric|digits:11',
	        'role' => 'required',
	    ]);
	    $user = new \Pianke\Models\AdminUser;
	    $user->username = \Request::input('username');
	    $user->name = \Request::input('name');
	    $user->password = bcrypt(\Request::input('password'));
	    $user->email = \Request::input('email');
	    $user->cell = \Request::input('cell');
	    $user->roleid = \Request::input('role');
	    if($user->save()){
	    	return redirect()->action('\Pianke\Http\Controllers\AdminManagerController@getUserlist')->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
		}else{
			return redirect()->action('\Pianke\Http\Controllers\AdminManagerController@getUserlist')->withNotice(['type'=>'error','msg'=>trans('admin.acterror'),'title'=>trans('admin.actfailed')]);
		}
	}

	//编辑用户
	public function getUseredit(){
		$roles = \Pianke\Models\AdminRole::all();
		$uinfo = \Pianke\Models\AdminUser::find(\Request::input('id'));
		return view('admin.user_edit',['roles'=>$roles,'uinfo'=>$uinfo]);
	}

	public function postUseredit(Request $request){
		$this->validate($request, [
	        'username' => 'required|unique:admin_users,username,'.\Request::input('id'),
	        'name' => 'required',
	        'email' => 'required|email',
	        'cell' => 'required|numeric|digits:11',
	        'role' => 'required',
	    ]);
	    $user = \Pianke\Models\AdminUser::find(\Request::input('id'));
	    $user->username = \Request::input('username');
	    $user->name = \Request::input('name');
	    if(!empty(\Request::input('password'))){
	    	$user->password = bcrypt(\Request::input('password'));
	    }
	    $user->email = \Request::input('email');
	    $user->cell = \Request::input('cell');
	    $user->roleid = \Request::input('role');
	    if($user->save()){
	    	return redirect()->action('\Pianke\Http\Controllers\AdminManagerController@getUserlist')->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
		}else{
			return redirect()->action('\Pianke\Http\Controllers\AdminManagerController@getUserlist')->withNotice(['type'=>'error','msg'=>trans('admin.acterror'),'title'=>trans('admin.actfailed')]);
		}
	}

	//禁用启用用户
	public function getUserstatus(){
		$id = \Request::input('id');
		$s = \Request::input('s')=='1'?0:1;
		$uinfo = \Pianke\Models\AdminUser::find($id);
		if($uinfo and $id != \Session::get('adminlogin')->id){
			$uinfo->status=$s;
			if($uinfo->save()){
		    	return redirect()->action('\Pianke\Http\Controllers\AdminManagerController@getUserlist')->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
			}else{
				return redirect()->action('\Pianke\Http\Controllers\AdminManagerController@getUserlist')->withNotice(['type'=>'error','msg'=>trans('admin.acterror'),'title'=>trans('admin.actfailed')]);
			}
		}else{
			return redirect()->action('\Pianke\Http\Controllers\AdminManagerController@getUserlist')->withNotice(['type'=>'warning','msg'=>trans('admin.notunactiveself'),'title'=>trans('admin.actfailed')]);
		}
	}

	//角色列表
	public function getRolelist(){
		$r = \Pianke\Models\AdminRole::all();
		return view('admin.role_list',['list'=>$r]);
	}

	//添加角色
	public function getRoleadd(){
		$list = \Pianke\Models\AdminPermission::getActiveArray();
		return view('admin.role_add',['plist' => $list]);
	}

	public function postRoleadd(Request $request){
		$this->validate($request, [
	        'name' => 'required|unique:admin_roles,name',
	        'desc' => 'required',
	    ]);
	    $role = new \Pianke\Models\AdminRole;
	    $role->name = \Request::input('name');
	    $role->desc = \Request::input('desc');
	    $role->permissions = implode('|', \Request::input('permissions'));
	   	if($role->save()){
	    	return redirect()->action('\Pianke\Http\Controllers\AdminManagerController@getRolelist')->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
		}else{
			return redirect()->action('\Pianke\Http\Controllers\AdminManagerController@getRolelist')->withNotice(['type'=>'error','msg'=>trans('admin.acterror'),'title'=>trans('admin.actfailed')]);
		}
	}

	//编辑角色
	public function getRoleedit(){
		$list = \Pianke\Models\AdminPermission::getActiveArray();
		$role = \Pianke\Models\AdminRole::find(\Request::input('id'));
		return view('admin.role_edit',['role' => $role,'plist'=>$list]);
	}

	public function postRoleedit(Request $request){
		$this->validate($request, [
	        'name' => 'required|unique:admin_roles,name,'.\Request::input('id'),
	        'desc' => 'required',
	    ]);
	    $role = \Pianke\Models\AdminRole::find(\Request::input('id'));
	    $role->name = \Request::input('name');
	    $role->desc = \Request::input('desc');
	    $role->permissions = implode('|', \Request::input('permissions'));
	   	if($role->save()){
	    	return redirect()->action('\Pianke\Http\Controllers\AdminManagerController@getRolelist')->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
		}else{
			return redirect()->action('\Pianke\Http\Controllers\AdminManagerController@getRolelist')->withNotice(['type'=>'error','msg'=>trans('admin.acterror'),'title'=>trans('admin.actfailed')]);
		}
	}

	//删除角色
	public function getRoledel(){
		$role = \Pianke\Models\AdminRole::find(\Request::input('id'));
		if($role){
			foreach ($role->users as $user) {
				$user->roleid = 1;
			}
			$role->push();
			$role->delete();
			return redirect()->action('\Pianke\Http\Controllers\AdminManagerController@getRolelist')->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
		}else{
			return redirect()->action('\Pianke\Http\Controllers\AdminManagerController@getRolelist')->withNotice(['type'=>'error','msg'=>trans('admin.acterror'),'title'=>trans('admin.actfailed')]);
		}
	}
}
