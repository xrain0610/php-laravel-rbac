<?php namespace Pianke\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model {

	public function users(){
		return $this->hasMany('\Pianke\Models\AdminUser', 'roleid', 'id');
	}

}
