<?php namespace Pianke\Http\Controllers;

use Pianke\Http\Requests;
use Pianke\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DefaultController extends Controller {

	public function getIndex(){
		return view('main.index');
	}

}
