<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
	/**
	 * Orders table name.
	 *
	 * @var string
	 */
	protected $tableName = 'orders';

	/**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
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
	public function up()
	{
		Schema::create($this->tableName, function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('cinematography_id');
			$table->string('payment_status');
            $table->integer('access_duration');
			$table->integer('cost');
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
