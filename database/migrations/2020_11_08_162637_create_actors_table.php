<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorsTable extends Migration
{
	/**
	 * Rates table name.
	 *
	 * @var string
	 */
	protected $tableName = 'actors';

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void
	{
		Schema::dropIfExists($this->tableName);
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
			$table->string('first_name');
			$table->string('last_name');
			$table->text('biography')->nullable();
			$table->timestamps();
		});
	}
}
