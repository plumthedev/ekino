<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
	/**
	 * Users table name.
	 *
	 * @var string
	 */
	protected $tableName = 'users';

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
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('email')->unique();
			$table->string('password');
			$table->timestamp('verified_at')->nullable();
			$table->timestamps();
		});
	}
}
