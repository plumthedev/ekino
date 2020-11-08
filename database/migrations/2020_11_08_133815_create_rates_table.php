<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
	/**
	 * Rates table name.
	 *
	 * @var string
	 */
	protected $tableName = 'rates';

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void
	{
		if (Schema::hasTable($this->tableName)) {

			Schema::table($this->tableName, function (Blueprint $table) {
				$table->dropForeign('user_id');
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
	public function up(): void
	{
		Schema::create($this->tableName, function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('cinematography_id');
			$table->float('score');
			$table->text('content');
			$table->integer('usefulness');
			$table->timestamps();

			$table->foreign('user_id')
				->on('users')->references('id')
				->onDelete('cascade');

			$table->foreign('cinematography_id')
				->on('cinematographies')->references('id')
				->onDelete('cascade');
		});
	}
}
