    <?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
        //非生产环境加载
        if(env('APP_ENV','production') != 'production'){
            $this->call('AdminUserTableSeeder');
            $this->call('AdminRoleTableSeeder');
        }

        //任何环境都加载
		$this->call('AdminPermissionTableSeeder');
	}

}

class AdminUserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('admin_users')->delete();

        \Pianke\Models\AdminUser::create(['roleid'=>2,'username'=>'test','name'=>'test','password'=>bcrypt('love1314'),'email'=>'xrain@simcu.com','cell'=>'18600127718']);
    }

}

class AdminRoleTableSeeder extends Seeder {

    public function run()
    {
        DB::table('admin_roles')->delete();
        \Pianke\Models\AdminRole::create(['id'=>'1','name'=>'无权限账户','desc'=>'除了可以访问主页和修改个人信息外,无任何权限','permissions'=>""]);
        \Pianke\Models\AdminRole::create(['id'=>'2','name'=>'系统管理员','desc'=>'系统最高权限管理员,拥有系统所有的权限','permissions'=>"all"]);
    }

}

class AdminPermissionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('admin_permissions')->delete();
        //系统管理菜单
        \Pianke\Models\AdminPermission::create(['desc'=>'admin.sys_manage_desc','id'=>1,'pid'=>0,'sort'=>9,'name'=>'admin.sys_manage','route'=>'fa fa-gear']);
        \Pianke\Models\AdminPermission::create(['desc'=>'admin.user_manage_desc','id'=>2,'pid'=>1,'sort'=>1,'name'=>'admin.user_manage','route'=>'\Pianke\Http\Controllers\AdminManagerController@getUserlist']);
        \Pianke\Models\AdminPermission::create(['desc'=>'admin.user_add_desc','id'=>3,'pid'=>1,'sort'=>2,'menu'=>0,'name'=>'admin.user_add','route'=>'\Pianke\Http\Controllers\AdminManagerController@getUseradd|\Pianke\Http\Controllers\AdminManagerController@postUseradd']);
        \Pianke\Models\AdminPermission::create(['desc'=>'admin.user_edit_desc','id'=>4,'pid'=>1,'sort'=>3,'menu'=>0,'name'=>'admin.user_edit','route'=>'\Pianke\Http\Controllers\AdminManagerController@getUseredit|\Pianke\Http\Controllers\AdminManagerController@postUseredit']);
        \Pianke\Models\AdminPermission::create(['desc'=>'admin.user_change_status_desc','id'=>5,'pid'=>1,'sort'=>4,'menu'=>0,'name'=>'admin.user_change_status','route'=>'\Pianke\Http\Controllers\AdminManagerController@getUserstatus']);
        \Pianke\Models\AdminPermission::create(['desc'=>'admin.role_manage_desc','id'=>6,'pid'=>1,'sort'=>5,'name'=>'admin.role_manage','route'=>'\Pianke\Http\Controllers\AdminManagerController@getRolelist']);
        \Pianke\Models\AdminPermission::create(['desc'=>'admin.role_add_desc','id'=>7,'pid'=>1,'sort'=>6,'menu'=>0,'name'=>'admin.role_add','route'=>'\Pianke\Http\Controllers\AdminManagerController@getRoleadd|\Pianke\Http\Controllers\AdminManagerController@postRoleadd']);
        \Pianke\Models\AdminPermission::create(['desc'=>'admin.role_edit_desc','id'=>8,'pid'=>1,'sort'=>7,'menu'=>0,'name'=>'admin.role_edit','route'=>'\Pianke\Http\Controllers\AdminManagerController@getRoleedit|\Pianke\Http\Controllers\AdminManagerController@postRoleedit']);
        \Pianke\Models\AdminPermission::create(['desc'=>'admin.role_delete_desc','id'=>9,'pid'=>1,'sort'=>8,'menu'=>0,'name'=>'admin.role_delete','route'=>'\Pianke\Http\Controllers\AdminManagerController@getRoledel']);
        \Pianke\Models\AdminPermission::create(['desc'=>'admin.permission_manage_desc','id'=>10,'pid'=>1,'sort'=>9,'name'=>'admin.permission_manage','route'=>'\Pianke\Http\Controllers\AdminManagerController@getPermission|\Pianke\Http\Controllers\AdminManagerController@getPeract|\Pianke\Http\Controllers\AdminManagerController@getPermenu']);
    }

}
