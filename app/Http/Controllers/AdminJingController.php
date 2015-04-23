<?php namespace Pianke\Http\Controllers;

use Pianke\Http\Requests;
use Pianke\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminJingController extends Controller {
	//静静列表
	public function getList(){
		$list = \Pianke\Models\Jing::all()->sortByDesc('start');
		return view('admin.jing_list',['list'=>$list]);
	}

	//推送静静
	public function getPush(){
		if(!\Pianke\Models\Jing::getById(\Request::input('id'))){
	    	return redirect()->back()->withNotice(['type'=>'error','msg'=>trans('admin.nopushcontent'),'title'=>trans('admin.actfailed')]);
		}
		\Cache::put('jing_lastest',\Request::input('id'),9999);
		return redirect()->action('\Pianke\Http\Controllers\AdminJingController@getList')->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
	}

	//添加静静
	public function getAdd(){
		return view('admin.jing_add');
	}
	public function postAdd(Request $request){
		$this->validate($request, [
	        'title' => 'required|unique:admin_users,username',
	        'author' => 'required',
	        'text' => 'required',
	        'audio' => 'required|max:2048',
	        'img' => 'required|image|max:250',
	        'video' => 'mimes:mp4|max:1536',
	        'start' => 'required|date_format:Ymd',
	    ]);
	    if(strtolower(\Request::file('audio')->getClientOriginalExtension()) != "mp3"){
	    	return redirect()->back()->withNotice(['type'=>'error','msg'=>trans('admin.filenotmp3'),'title'=>trans('admin.filecheckno')]);
	    }
	    $njing = new \Pianke\Models\Jing;
	    //开始进行图片的操作
	    $filename = md5(\Request::input('title').\Request::input('author').time());
	    $uri = "/jing/images/";
	    $njing->img = $this->_fileSave('img',$filename,$uri);
	    //音频文件的操作
	    $uri = "/jing/audios/";
	    $njing->audio = $this->_fileSave('audio',$filename,$uri);
	    //如果上传了视频,进行视频文件存储
	    if(\Request::hasFile('video')){
		    $uri = "/jing/videos/";
		    $njing->video = $this->_fileSave('video',$filename,$uri);
	    }
	    $njing->title = \Request::input('title');
	    $njing->author = \Request::input('author');
	    $njing->text = \Request::input('text');
	    $njing->start = \Request::input('start');
	    if($njing->save()){
	    	return redirect()->action('\Pianke\Http\Controllers\AdminJingController@getList')->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
		}else{
			return redirect()->action('\Pianke\Http\Controllers\AdminJingController@getAdd')->withNotice(['type'=>'error','msg'=>trans('admin.acterror'),'title'=>trans('admin.actfailed')]);
		}
	}

	//文件操作
	private function _fileSave($file,$filename,$uri){
		$filename = $filename.".".\Request::file($file)->getClientOriginalExtension();
		$res = \Tools::upFile($_FILES[$file]['tmp_name'],$uri.$filename);
		if($res){
			return $res;
		}else{
	    	return redirect()->back()->withNotice(['type'=>'error','msg'=>trans('admin.filelocalsaveno'),'title'=>trans('admin.filecheckno')]);
	    }
	}

	//编辑静静
	public function getEdit(){
		$jdata = \Pianke\Models\Jing::find(\Request::input('id'));
		return view('admin.jing_edit',['data'=>$jdata]);
	}
	public function postEdit(Request $request){
		$this->validate($request, [
	        'title' => 'required|unique:admin_users,username',
	        'author' => 'required',
	        'text' => 'required',
	        'img' => 'image|max:250',
	        'audio' => 'max:2048',
	        'video' => 'mimes:mp4|max:1536',
	        'start' => 'required|date_format:Ymd',
	    ]);
	    $njing = \Pianke\Models\Jing::find(\Request::input('id'));
	    $filename = md5(\Request::input('title').\Request::input('author').time());
	    if(\Request::hasFile('audio')){
	    	if(strtolower(\Request::file('audio')->getClientOriginalExtension()) != "mp3"){
		    	return redirect()->back()->withNotice(['type'=>'error','msg'=>trans('admin.filenotmp3'),'title'=>trans('admin.filecheckno')]);
		    }
		    //音频文件的操作
		    $uri = "/jing/audios/";
		    $njing->audio = $this->_fileSave('audio',$filename,$uri);
	    }
	    //开始进行图片的操作
	    if(\Request::hasFile('img')){
		    $uri = "/jing/images/";
		    $njing->img = $this->_fileSave('img',$filename,$uri);
		}
	    //如果上传了视频,进行视频文件存储
	    if(\Request::hasFile('video')){
		    $uri = "/jing/videos/";
		    $njing->video = $this->_fileSave('video',$filename,$uri);
	    }
	    $njing->title = \Request::input('title');
	    $njing->author = \Request::input('author');
	    $njing->text = \Request::input('text');
	    $njing->start = \Request::input('start');
	    if($njing->save()){
	    	\Cache::forget('jing_'.\Request::input('id'));
	    	return redirect()->action('\Pianke\Http\Controllers\AdminJingController@getList')->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
		}else{
			return redirect()->action('\Pianke\Http\Controllers\AdminJingController@getAdd')->withNotice(['type'=>'error','msg'=>trans('admin.acterror'),'title'=>trans('admin.actfailed')]);
		}
	}

	//删除静静
	public function getDel(){
		if(\Cache::get('jing_lastest') == \Request::input('id')){
	    	return redirect()->back()->withNotice(['type'=>'error','msg'=>trans('admin.inpushnotdo'),'title'=>trans('admin.actfailed')]);
		}
		$info = \Pianke\Models\Jing::find(\Request::input('id'));
		if($info->delete()){
			\Cache::forget('jing_'.\Request::input('id'));
			return redirect()->action('\Pianke\Http\Controllers\AdminJingController@getList')->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
		}else{
			return redirect()->action('\Pianke\Http\Controllers\AdminJingController@getList')->withNotice(['type'=>'error','msg'=>trans('admin.acterror'),'title'=>trans('admin.actfailed')]);
		}
	}

	//启用/禁用静静
	public function getStatus(){
		if(\Cache::get('jing_lastest') == \Request::input('id')){
	    	return redirect()->back()->withNotice(['type'=>'error','msg'=>trans('admin.inpushnotdo'),'title'=>trans('admin.actfailed')]);
		}
		$id = \Request::input('id');
		$s = \Request::input('s')=='1'?0:1;
		$info = \Pianke\Models\Jing::find($id);
		if($info){
			$info->status=$s;
			if($info->save()){
				\Cache::forget('jing_'.\Request::input('id'));
		    	return redirect()->action('\Pianke\Http\Controllers\AdminJingController@getList')->withNotice(['type'=>'success','msg'=>'','title'=>trans('admin.actsuccess')]);
			}else{
				return redirect()->action('\Pianke\Http\Controllers\AdminJingController@getList')->withNotice(['type'=>'error','msg'=>trans('admin.acterror'),'title'=>trans('admin.actfailed')]);
			}
		}else{
			return redirect()->action('\Pianke\Http\Controllers\AdminJingController@getList')->withNotice(['type'=>'warning','msg'=>trans('admin.notunactiveself'),'title'=>trans('admin.actfailed')]);
		}
	}
}
