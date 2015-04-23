<?php namespace Pianke\Http\Controllers;

use Pianke\Http\Requests;
use Pianke\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminDownloadController extends Controller {

	//下载详情列表
	public function getList(){
		$dlist = \Pianke\Models\Download::all()->sortBy('id');
		return view('admin.download_list',['list'=>$dlist]);
	}

	//添加新下载项目
	public function getAdd(){
		return view('admin.download_add');
	}
	public function postAdd(Request $request){
		$this->validate($request, [
	        'name' => 'required|unique:downloads,name',
	        'desc' => 'required',
	        'start' => 'required|date_format:Ymd',
	    ]);
	    $link = new \Pianke\Models\Download;
	    $link->name = \Request::input('name');
	    $link->desc = \Request::input('desc');
	    $link->start = \Request::input('start');
	    $link->ident = md5(\Request::input('name').\Request::input('desc').\Request::input('start').microtime());
	    $link->link = \Config::get('app.url')."/download/".$link->ident;
	    $link->qrcode = \Tools::qrcode($link->link);
	    if($link->save()){
	    	return redirect()->action('\Pianke\Http\Controllers\AdminDownloadController@getList')->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
		}else{
			return redirect()->action('\Pianke\Http\Controllers\AdminDownloadController@getAdd')->withNotice(['type'=>'error','msg'=>trans('admin.acterror'),'title'=>trans('admin.actfailed')]);
		}
 	}

	//删除下载
	public function getDel(){
		$info = \Pianke\Models\Download::find(\Request::input('id'));
		if($info->delete()){
			return redirect()->action('\Pianke\Http\Controllers\AdminDownloadController@getList')->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
		}else{
			return redirect()->action('\Pianke\Http\Controllers\AdminDownloadController@getList')->withNotice(['type'=>'error','msg'=>trans('admin.acterror'),'title'=>trans('admin.actfailed')]);
		}
	}

	//统计
	public function getCounter(){
		$info = \Pianke\Models\Download::find(\Request::input('id'));
		$start = $info->start;
		$ident = $info->ident;
		$redis = \Redis::connection('counter');
		$date = date('Ymd');
		$i = 1;
		do {
			$list[] = [
				'date' => $date,
				'android' => $redis->get('download_android_'.$ident."_".$date),
				'ios' => $redis->get('download_ios_'.$ident."_".$date),
				'total' => $redis->get('download_android_'.$ident."_".$date) + $redis->get('download_ios_'.$ident."_".$date)
			];
			$date = date("Ymd",strtotime("-$i day"));
			$i++;
		} while ( $date >= $start);
		$viewdata = [
			'name' => $info->name,
			'link' => $info->link,
			'android' => $redis->get('download_android_'.$ident.'_all'),
			'ios' => $redis->get('download_ios_'.$ident.'_all'),
			'list' => $list,
		];
		return view('admin.download_counter',$viewdata);
	}
}
