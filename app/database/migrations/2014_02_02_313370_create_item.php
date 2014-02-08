<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;


class CreateItem extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		Schema::create('item', function (Blueprint $table) {

			$table
				->increments('id')
				->unsigned()
			;

			$table->string('title');

			$table->string('slug');

			$table->timestamps();

			//
			// Indexes
			//

			$table->unique('slug', 'U_slug');

		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('item');
	}

}