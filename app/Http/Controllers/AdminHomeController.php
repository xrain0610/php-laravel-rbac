<?php namespace Pianke\Http\Controllers;

use Pianke\Http\Requests;
use Pianke\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminHomeController extends Controller {
	//用户中心首页
	public function getIndex()
	{	
		$redis = \Redis::connection('counter');
		//静静IOS信息widget
		$mcjios = $redis->get('jing_counter_1_'.date('Ymd'));
		$mcjy = $redis->get('jing_counter_1_'.date("Ymd",strtotime("-1 day")))?$redis->get('jing_counter_1_'.date("Ymd",strtotime("-1 day"))):1;
		$jingiosper = round(($mcjios - $mcjy) / $mcjy * 100);
		//静静ANDROID信息widget
		$mcjandroid = $redis->get('jing_counter_2_'.date('Ymd'));
		$mcjy = $redis->get('jing_counter_2_'.date("Ymd",strtotime("-1 day")))?$redis->get('jing_counter_2_'.date("Ymd",strtotime("-1 day"))):1;
		$jingandroidper = round(($mcjandroid - $mcjy) / $mcjy * 100);
		//静静分享统计信息widget
		$mcjshare = $redis->get('jing_counter_3_'.date('Ymd'));
		$mcjy = $redis->get('jing_counter_3_'.date("Ymd",strtotime("-1 day")))?$redis->get('jing_counter_3_'.date("Ymd",strtotime("-1 day"))):1;
		$jingshareper = round(($mcjandroid - $mcjy) / $mcjy * 100);
		//android下载统计widget
		$downa = $redis->get('download_android_'.date('Ymd'));
		$downay = $redis->get('download_android_'.date("Ymd",strtotime("-1 day")))?$redis->get('download_android_'.date("Ymd",strtotime("-1 day"))):1;
		$downaper = round(($downa - $downay) / $downay * 100);
		//ios下载统计widget
		$downi = $redis->get('download_ios_'.date('Ymd'));
		$downiy = $redis->get('download_ios_'.date("Ymd",strtotime("-1 day")))?$redis->get('download_ios_'.date("Ymd",strtotime("-1 day"))):1;
		$downiper = round(($downi - $downiy) / $downiy * 100);
		$viewdata = [
			'jing_ios_count' => $mcjios,
			'jing_ios_count_per' => $jingiosper,
			'jing_android_count' => $mcjandroid,
			'jing_android_count_per' => $jingandroidper,
			'jing_share_count' => $mcjshare,
			'jing_share_count_per' => $jingshareper,
			'android_count' => $downa,
			'android_count_per' => $downaper,
			'ios_count' => $downi,
			'ios_count_per' => $downiper
			];
		return view('admin.home_index',$viewdata);
	}

	//用户资料修改
	public function getProfile(){
		$uinfo = \Session::get('adminlogin');
		return view('admin.home_profile',['uinfo'=>$uinfo]);
	}

	public function postProfile(Request $request){
		$this->validate($request, [
	        'name' => 'required',
	        'email' => 'required|email',
	        'cell' => 'required|numeric|digits:11',
	    ]);
	    $uinfo = \Session::get('adminlogin');
	    $uinfo->name = \Request::input('name');
	    $uinfo->email = \Request::input('email');
	    $uinfo->cell = \Request::input('cell');
	    if($uinfo->save()){
	    	return redirect()->back()->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
		}else{
			return redirect()->back()->withNotice(['type'=>'error','msg'=>trans('admin.acterror'),'title'=>trans('admin.actfailed')]);
		}
	}

	//密码修改
	public function getChangepass(){
		$uinfo = \Session::get('adminlogin');
		return view('admin.change_pass',['uinfo'=>$uinfo]);
	}

	public function postChangepass(Request $request){
		$this->validate($request, [
	        'oldpass' => 'required',
	        'newpass' => 'required|min:6',
	        'conpass' => 'required|same:newpass',
	    ]);
	    $uinfo = \Session::get('adminlogin');
	    if(\Hash::check(\Request::input('oldpass'), $uinfo->password)){
	    	$uinfo->password=bcrypt(\Request::input('newpass'));
		    if($uinfo->save()){
		    	return redirect()->action('\Pianke\Http\Controllers\AdminHomeController@getIndex')->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
			}else{
				return redirect()->back()->withNotice(['type'=>'error','msg'=>trans('admin.acterror'),'title'=>trans('admin.actfailed')]);
			}
		}else{
			return redirect()->back()->withNotice(['type'=>'error','msg'=>trans('common.oldpasswrong'),'title'=>trans('admin.actfailed')]);
		}
	}

	//上传头像
	public function getUploadphoto(){
		return view('admin.upload_photo');
	}

	public function postUploadphoto(Request $request){
		$this->validate($request, [
	        'photo' => 'required|image|max:2048',
	    ]);
	    $uinfo = \Session::get('adminlogin');
	    $filename = 'photo_'.$uinfo->id."_".date("YmdHis").md5('photo_'.$uinfo->id."_".date("YmdHis")).'.'.\Request::file('photo')->getClientOriginalExtension();
	    if(\Request::file('photo')->move(public_path()."/uploads/photo/".$uinfo->id,$filename)){
	    	$uinfo->photo = '/uploads/photo/'.$uinfo->id."/".$filename;
	    	if($uinfo->save()){
		    	return redirect()->action('\Pianke\Http\Controllers\AdminHomeController@getIndex')->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
			}else{
				return redirect()->back()->withNotice(['type'=>'error','msg'=>trans('admin.acterror'),'title'=>trans('admin.actfailed')]);
			}
		}else{
			return redirect()->back()->withNotice(['type'=>'error','msg'=>trans('admin.uploadfailed'),'title'=>trans('admin.actfailed')]);
		}
	}

	//通知消息获取接口
	public function getNotice(){
		$uinfo = \Session::get('adminlogin');
		$redis = \Redis::connection('notice');
		$msgs = $redis->get($uinfo->id."_msgs")?json_decode($redis->get($uinfo->id."_msgs"),true):[];
		$alerts =  $redis->get($uinfo->id."_alerts")?json_decode($redis->get($uinfo->id."_alerts"),true):[];
		$ret = [
			'msg' => [
				'num' => count($msgs),
				'list' => $msgs,
			],
			'alert' => [
				'num' => count($alerts),
				'list' => $alerts,
			],
		];
		return response()->json(json_encode($ret));
	}

	//处理通知消息
	public function getProcessNotice(){
		$uinfo = \Session::get('adminlogin');
		$redis = \Redis::connection('notice');
		switch (\Request::input('k')) {
			case 'all_msg':
				$redis->del($uinfo->id."_msgs");
				return redirect()->back();
				break;
			case 'all_alert':
				$redis->del($uinfo->id."_alerts");
				return redirect()->back();
				break;
			default:
				$msgs = json_decode($redis->get($uinfo->id."_msgs"), true);
				$content = array_get($msgs, \Request::input('k'));
				if ($content) {
					array_forget($msgs, \Request::input('k'));
					$redis->set($uinfo->id . "_msgs", json_encode($msgs));
				}else{
				$alerts = json_decode($redis->get($uinfo->id . "_alerts"), true);
				$content = array_get($alerts, \Request::input('k'));
				array_forget($alerts, \Request::input('k'));
				$redis->set($uinfo->id . "_alerts", json_encode($alerts));
				}
				if ($content['action'] != '#') {
					return redirect()->action($content['action']);
				}
				return redirect()->back();
		}
	}
}
