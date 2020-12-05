<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessesTable extends Migration
{
    /**
     * Accesses table name.
     *
     * @var string
     */
    protected $tableName = 'accesses';

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
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('cinematography_id');
            $table->string('key');
            $table->string('status');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->on('users')->references('id')
                ->onDelete('cascade');

            $table->foreign('order_id')
                ->on('orders')->references('id')
                ->onDelete('cascade');

            $table->foreign('cinematography_id')
                ->on('cinematographies')->references('id')
                ->onDelete('cascade');
        });
    }

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
                $table->dropForeign('order_id');
                $table->dropForeign('cinematography_id');
            });

            Schema::dropIfExists($this->tableName);
        }
    }
}
