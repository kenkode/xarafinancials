<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpensesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('expenses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('amount');
			$table->string('type');
			$table->date('date')->nullable();
			$table->integer('asset_journal_id')->nullable();
			$table->integer('expense_journal_id')->nullable();
			$table->integer('asset_account_id')->nullable();
			$table->integer('expense_account_id')->nullable();
			$table->integer('account_id')->unsigned();
			//$table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
			$table->integer('organization_id')->nullable()->unsigned();
			$table->integer('void')->nullable()->default('0');
			//$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('restrict')->onUpdate('cascade');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('expenses');
	}

}
