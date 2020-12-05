<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPlansTable extends Migration
{
	/**
	 * Subscription plans table name.
	 *
	 * @var string
	 */
	protected $tableName = 'subscription_plans';
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists($this->tableName);
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->tableName, function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->text('description');
			$table->integer('price');
			$table->boolean('is_featured');
			$table->integer('access_duration');
			$table->timestamps();
		});
	}
}
