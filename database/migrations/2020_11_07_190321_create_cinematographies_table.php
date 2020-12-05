<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinematographiesTable extends Migration
{
	/**
	 * Cinematographies table name.
	 *
	 * @var string
	 */
	protected $tableName = 'cinematographies';

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void
	{
		if (Schema::hasTable($this->tableName)) {

			Schema::table($this->tableName, function (Blueprint $table) {
				$table->dropForeign('subscription_plan_id');
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
			$table->unsignedBigInteger('subscription_plan_id')->nullable();
			$table->string('type');
			$table->string('title');
			$table->longText('content');
			$table->time('duration')->nullable();
			$table->float('rating');
			$table->json('meta');
			$table->date('produced_at');
			$table->timestamps();

			$table->foreign('subscription_plan_id')
				->on('subscription_plans')->references('id')
				->onDelete('cascade');
		});
	}
}
