<?php namespace Pianke\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	protected $listen = [
		//创建新用户的事件
		'Pianke\Events\UserCreate' => [
			'Pianke\Handlers\Events\UserInfoCreate', 			//添加用户信息表
			'Pianke\Handlers\Events\SendUserEmailConfirm'		//发送验证邮件
		],
	];

	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//创建新用户时候顺便创建用户信息
		\Pianke\Models\User::created(function($user){
			event(new \Pianke\Events\UserCreate($user));
		});
	}

}
