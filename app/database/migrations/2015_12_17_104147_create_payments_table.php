<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table)
		{
			$table->increments('id');			
			$table->integer('client_id')->unsigned();
			$table->integer('account_id')->unsigned();
			$table->integer('erporder_id')->unsigned();
			$table->foreign('erporder_id')->references('id')->on('erporders');
			$table->date('date')->nullable();
			$table->double('amount_paid')->default(0);
			$table->string('received_by')->nullable();
			$table->integer('paymentmethod_id')->unsigned();
			//$table->foreign('paymentmethod_id')->references('id')->on('paymentmethods');
			$table->integer('organization_id')->nullable()->unsigned();
			//$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('restrict')->onUpdate('cascade');
			$table->integer('receivable_journal_id')->nullable();
			$table->integer('cash_journal_id')->nullable();
			$table->integer('receivable_acc_id')->nullable();
			$table->integer('cash_account_id')->nullable();
			$table->integer('void')->nullable();
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
		Schema::drop('payments');
	}

}
