<?php

use Illuminate\Database\Migrations\Migration;

class CreatePostingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('postings', function($table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->text('content');
			$table->dateTime('expires_at');
			$table->smallInteger('closed');
			$table->string('title');
			$table->integer('category_id');
			$table->string('area');
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
		Schema::drop('postings');
	}

}