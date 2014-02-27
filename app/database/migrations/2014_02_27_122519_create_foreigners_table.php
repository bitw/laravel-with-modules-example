<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('foreigners', function($table){
            $table->increments('id');
            $table->string('name', 20);
            $table->string('surname', 20);
            $table->string('organization', 200);
            $table->string('email');
            $table->string('phone');
            $table->longText('data');
            $table->string('key', 8);
            $table->float('payment_amount');
            $table->boolean('paid', false);
            $table->mediumText('billing_information');
            $table->timestamps();
            $table->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
