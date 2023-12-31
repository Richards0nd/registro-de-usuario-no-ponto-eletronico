<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('employees', function (Blueprint $table) {
			$table->string('name', 100)->nullable()->change();
			$table->string('email', 100)->nullable()->change();
			$table->string('phone', 15)->nullable()->change();
			$table->json('knowledges')->nullable()->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('employees', function (Blueprint $table) {
			$table->string('name', 100)->nullable(false)->change();
			$table->string('email', 100)->nullable(false)->change();
			$table->string('phone', 15)->nullable(false)->change();
			$table->json('knowledges')->nullable(false)->change();
		});
	}
};
