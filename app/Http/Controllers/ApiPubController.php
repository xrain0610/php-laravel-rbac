<?php namespace Pianke\Http\Controllers;

use Pianke\Commands\uploadFile;
use Pianke\Http\Requests;
use Pianke\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ApiPubController extends Controller {

	public function postJing(){
		$jinfo = \Pianke\Models\Jing::getById(\Cache::get('jing_lastest'));
		if(\Redis::get(\Request::input('client')."_".\Request::input('did')) != date('Ymd')){
			\Redis::connection('counter')->INCR('jing_counter_'.\Request::input('client')."_".date('Ymd'));
			\Redis::connection('counter')->INCR('jing_counter_'.\Request::input('client').'_id_'.$jinfo['id']);
			\Redis::set(\Request::input('client')."_".\Request::input('did'),date('Ymd'));
		}
		$mcj = \Redis::connection('counter')->get('jing_counter_1_'.date('Ymd')) + \Redis::connection('counter')->get('jing_counter_2_'.date('Ymd'));
		if($jinfo) {
			$res = [
				'enable' => \Config::get('jing_switch', 'on') == 'on' ? true : false,
				'id' => $jinfo['id'] . '',
				'title' => $jinfo['title'],
				'author' => $jinfo['author'],
				'audio' => $this->uploads . $jinfo['audio'],
				'video' => $jinfo['video'] ? $this->uploads . $jinfo['video'] : '',
				'img' => $this->uploads . $jinfo['img'],
				'text' => $jinfo['text'],
				'today_count' => $mcj,
				'shareinfo' => array(
					'title' => $jinfo['title'],
					'pic' => $this->uploads . $jinfo['img'],
					'text' => $jinfo['text'],
					'url' => "http://new.pianke.me/jing/play?id=" . $jinfo['id'],
				),
			];
			$ret = \Tools::apiRes($res);
		}else{
			$ret = \Tools::apiErr('SE20001');
		}
		return response()->json($ret);
	}


}
