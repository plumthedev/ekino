<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinematographyCountriesTable extends Migration
{
    /**
     * Cinematography countries pivot table name.
     *
     * @var string
     */
    protected $tableName = 'cinematography_countries';

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable($this->tableName)) {

            Schema::table($this->tableName, function (Blueprint $table) {
                $table->dropForeign('country_id');
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
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('cinematography_id');

            $table->foreign('country_id')
                ->on('countries')->references('id')
                ->onDelete('cascade');

            $table->foreign('cinematography_id')
                ->on('cinematographies')->references('id')
                ->onDelete('cascade');
        });
    }
}
