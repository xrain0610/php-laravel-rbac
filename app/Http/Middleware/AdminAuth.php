<?php namespace Pianke\Http\Middleware;

use Closure;

class AdminAuth {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{	
		//检测是否登录,未登录跳转,登录了赋予菜单
		if(\Session::has('adminlogin')){
			if(!env('PERMISSION_USE_CACHE','true')){
				$uinfo = \Pianke\Models\AdminUser::find(\Session::get('adminlogin')->id);
				\Session::put('adminlogin',$uinfo);
				\Pianke\Models\AdminPermission::getCurPermissionArray(explode("|", $uinfo->role->permissions));
			}
			view()->share('menu',\Session::get('menu'));
		}else{
			return redirect()->action('\Pianke\Http\Controllers\AdminLoginController@getLogin');
		}
		//检测是否有权限访问操作
		if(!in_array('\\'.\Route::currentRouteAction(), \Session::get('curpermissions'))){
			return redirect()->back()->withNotice(['type'=>'error','msg'=>trans('admin.nopermission'),'title'=>trans('admin.permissionerror')]);
		}
		return $next($request);
	}

}
