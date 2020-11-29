<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinematographiesSubscriptionPlansTable extends Migration
{
	/**
	 * Cinematographies subscription plans pivot table name.
	 *
	 * @var string
	 */
	protected $tableName = 'cinematographies_subscription_plans';

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
			$table->unsignedBigInteger('cinematography_id');
			$table->unsignedBigInteger('subscription_plan_id');

			$table->foreign('subscription_plan_id')
				->on('subscription_plans')->references('id')
				->onDelete('cascade');

			$table->foreign('cinematography_id')
				->on('cinematographies')->references('id')
				->onDelete('cascade');
		});
	}
}
