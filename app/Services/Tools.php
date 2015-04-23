<?php namespace Pianke\Services;
//片刻-董帅 自定义方法

use Config;

class Tools {

	//根据二维数组中的元素进行排序
	public static function array_vsort(array $array, $field, $sort_type=NULL){
		if($sort_type==NULL){
			$sort_type = SORT_ASC;
		}else{
			$sort_type = SORT_DESC;
		}
		$arrSort = [];
		foreach($array AS $uniqid => $row){  
		    foreach($row AS $key=>$value){  
		        $arrSort[$key][$uniqid] = $value;  
		    }  
		}
		array_multisort($arrSort[$field], $sort_type, $array);
		return $array;
	}

	//根据配置输出静态文件地址
	//如果参数是true返回uploads路径,否则返回static资源路径
	public static function filePath($getuploads=false){
		if($getuploads){
			$type = "uploads";
		}else{
			$type = "static";
		}
		$temp_array = \Config::get('services.fileurl');
		return $temp_array[\Config::get('app.file_service')][$type];
	}

	//在表单插入token
	public static function token(){
		echo '<input type="hidden" name="_token" value="'.csrf_token().'">';
	}

	//发送Notice到用户
	public static function notice($text,$uid,$action="#"){
		if($action != "#"){
			$tmp = $uid."_msgs";
		}else{
			$tmp = $uid."_alerts";
		}
		$redis = \Redis::connection('notice');
		$old = $redis->get($tmp)?json_decode($redis->get($tmp),true):[];
		$key = md5($text.$uid.microtime());
		$new = [
			'text' => $text,
			'action' => $action,
			'time' => date('Y-m-d H:i:s'),
		];
		$old[$key] = $new;
		$ret = json_encode($old);
		if($redis->set($tmp,$ret)){
			return true;
		}else{
			return false;
		}
	}

	//上传文件到文件服务器
	public static function upFile($local,$remote){
		switch(\Config::get("services.fileuse")){
			case "cdn":
				$data = [
					'file' => curl_file_create($local),
					'path' => $remote,
					'md5' => md5_file($local),
				];

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, \Config::get('services.fileurl.cdn.api'));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				$output = curl_exec($ch);
				curl_close($ch);
				if($output == 'SUCCESS'){
					return $remote;
				}else{
					return false;
				}
				break;
			default:
				$save = public_path()."/uploads".$remote;
				$path = dirname($save);
				if(!is_dir($path)){
					mkdir($path,0777,true);
				}
				if(copy($local,$save)) {
					unlink($local);
					return $remote;
				}else{
					return false;
				}
				break;

		}

	}
}