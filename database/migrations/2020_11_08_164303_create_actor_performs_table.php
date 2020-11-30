<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorPerformsTable extends Migration
{
	/**
	 * Actor performs pivot table name.
	 *
	 * @var string
	 */
	protected $tableName = 'actor_performs';

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable($this->tableName)) {

			Schema::table($this->tableName, function (Blueprint $table) {
				$table->dropForeign('actor_id');
				$table->dropForeign('cinematography_id');
			});

			Schema::dropIfExists($this->tableName);
		}
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->tableName, function (Blueprint $table) {
			$table->unsignedBigInteger('actor_id');
			$table->unsignedBigInteger('cinematography_id');
			$table->string('perform_name');

			$table->foreign('actor_id')
				->on('actors')->references('id')
				->onDelete('cascade');

			$table->foreign('cinematography_id')
				->on('cinematographies')->references('id')
				->onDelete('cascade');
		});
	}
}
