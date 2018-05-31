<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTastingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_code', 10);
            $table->integer('customer_id', 11);
            $table->string('customer_name', 255);
            $table->string('customer_email', 255);
            $table->decimal('customer_phone', 20);
            $table->string('customer_address', 255);
            $table->string('customer_district', 255);
            $table->string('customer_city', 255);
            $table->text('customer_content');
            $table->tinyInteger('status');
            $table->dateTime('time');
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
        Schema::dropIfExists('tasting');
    }
}
