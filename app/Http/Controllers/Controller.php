<?php namespace Pianke\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;
	function __construct(){
		$uploads_path = \Tools::filePath(true);
		$this->uploads = $uploads_path;
		view()->share('uploads',$uploads_path);
		view()->share('static',\Tools::filePath());
	}
}
