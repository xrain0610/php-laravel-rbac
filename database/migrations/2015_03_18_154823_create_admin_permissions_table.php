<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_permissions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('pid')->default(0);
			$table->string('name');
			$table->string('desc')->default('很懒,也不说一下这个是什么');
			$table->string('route');
			$table->bigInteger('sort')->default(0);
			$table->boolean('menu')->default(1);
			$table->boolean('status')->default(1);	
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admin_permissions');
	}

}
