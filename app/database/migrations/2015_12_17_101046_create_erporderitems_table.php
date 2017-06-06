<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateErporderitemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('erporderitems', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('item_id')->unsigned();
			$table->foreign('item_id')->references('id')->on('items');
			$table->integer('quantity')->default(1);
			$table->string('issued_by')->nullable();
			$table->date('date_of_issue')->nullable();
			$table->date('date_of_return')->nullable();
			$table->string('status')->nullable();
			$table->boolean('is_returned')->default(0);
			$table->double('rate')->default(0);
			$table->integer('duration')->nullable();
			$table->integer('erporder_id')->unsigned();
			$table->foreign('erporder_id')->references('id')->on('erporders');
			$table->double('price')->nullable();
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
		Schema::drop('erporderitems');
	}

}
