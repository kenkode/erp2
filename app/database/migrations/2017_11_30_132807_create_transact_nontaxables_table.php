<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactNontaxablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transact_nontaxables', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employee_id')->unsigned();
			$table->foreign('employee_id')->references('id')->on('employee')->onDelete('restrict')->onUpdate('cascade');
			$table->integer('employee_nontaxable_id')->unsigned();
			$table->integer('nontaxable_id')->unsigned();
			$table->string('nontaxable_name');
			$table->string('nontaxable_amount')->default('0.00');
			$table->string('financial_month_year');
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
		Schema::drop('transact_deductions');
	}

}