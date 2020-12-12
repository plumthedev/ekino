<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinematographyGenres extends Migration
{
    /**
     * Cinematography countries pivot table name.
     *
     * @var string
     */
    protected $tableName = 'cinematography_genres';

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable($this->tableName)) {

            Schema::table($this->tableName, function (Blueprint $table) {
                $table->dropForeign('genre_id');
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
            $table->unsignedBigInteger('genre_id');
            $table->unsignedBigInteger('cinematography_id');

            $table->foreign('genre_id')
                ->on('genres')->references('id')
                ->onDelete('cascade');

            $table->foreign('cinematography_id')
                ->on('cinematographies')->references('id')
                ->onDelete('cascade');
        });
    }
}
