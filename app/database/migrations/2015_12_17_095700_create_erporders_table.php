<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateErpordersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('erporders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('client_id')->unsigned();
			$table->foreign('client_id')->references('id')->on('clients');
			$table->integer('asset_acc_id')->nullable();
			$table->integer('income_acc_id')->nullable();
			$table->integer('purchase_acc_id')->nullable();
			$table->integer('payable_acc_id')->nullable();
			$table->date('date')->nullable();
			$table->string('status')->nullablle();
			$table->double('total_amount')->nullable();
			$table->double('discount_amount')->nullable();
			$table->string('type');
			$table->boolean('is_lease')->default(0);
			$table->string('payment_type')->nullable();
			$table->string('order_number')->nullable();
			$table->string('inv_number')->nullable();
			$table->date('due_date')->nullable();
			$table->string('ordered_by')->nullable();
			$table->integer('organization_id')->nullable()->unsigned();
			$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('restrict')->onUpdate('cascade');
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
		Schema::drop('erporders');
	}

}
