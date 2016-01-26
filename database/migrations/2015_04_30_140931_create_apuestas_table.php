<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApuestasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apuestas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('users_id');
			$table->decimal('total', 15,2);
			$table->integer('redondeo');
			$table->string('slug')->default('');
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
		Schema::drop('apuestas');
	}

}
