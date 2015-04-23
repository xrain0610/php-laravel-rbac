<?php namespace Pianke\Http\Controllers;

use Pianke\Http\Requests;
use Pianke\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminHelperController extends Controller {

	//文件上传
	public function getUpload(){
		return view('admin.helper_upload');
	}
	public function postUpload(){
		if (\Request::file('file')->isValid()){
			$uri = '/old/newuploads/';
			$filename = md5($_FILES['file']['tmp_name'].microtime()).".".\Request::file('file')->getClientOriginalExtension();
			$res = \Tools::upFile($_FILES['file']['tmp_name'],$uri.$filename);
			if($res){
				return response()->json(['status' => 1, 'url' => \Tools::filePath(true).$res]);
			}else{
				return response(trans('admin.uploadfaild'),444);
			}
		}
	}

}
