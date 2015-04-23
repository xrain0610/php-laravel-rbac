<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('roleid')->default(0);
			$table->string('username')->unique();
			$table->string('name');
			$table->string('password',60);
			$table->string('photo')->default('/img/nophoto.jpg');
			$table->string('email')->nullable();
			$table->string('cell',11)->nullable();
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
		Schema::drop('admin_users');
	}

}
