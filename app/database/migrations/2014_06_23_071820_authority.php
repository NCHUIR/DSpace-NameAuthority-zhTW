<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Authority extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('authority', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('authority_id')->unsigned()->default(0);
			$table->string('name');
			$table->string('lang')->default('');
			$table->timestamps();

			$table->index('authority_id');
			$table->index('name');
		});

		Schema::create('metaphone', function($table){
			$table->engine='InnoDB';
			$table->increments('id');
			$table->string('metaphone');
			$table->unique('metaphone');
		});

		Schema::create('authority2metaphone', function($table){
			$table->increments('id');
			$table->integer('authority_id')->unsigned()->default(0);
			$table->integer('metaphone_id')->unsigned()->default(0);
			$table->unique( array('authority_id', 'metaphone_id') );
		});

		Schema::create('utf8pinyin', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('utf8');
			$table->string('pinyin');
			$table->timestamps();

			$table->index('utf8');
			$table->index('pinyin');
			$table->unique(array('utf8','pinyin'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('authority');
		Schema::dropIfExists('utf8pinyin');
		Schema::dropIfExists('metaphone');
		Schema::dropIfExists('authority2metaphone');
	}

}
