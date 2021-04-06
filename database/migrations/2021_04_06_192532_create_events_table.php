<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('territory_id')->unsigned()->nullable();
            $table->string('event_type');
            $table->string('data1')->nullable();
            $table->string('desc1')->nullable();
            $table->string('data2')->nullable();
            $table->string('desc2')->nullable();
            $table->string('data3')->nullable();
            $table->string('desc3')->nullable();
            $table->string('data4')->nullable();
            $table->string('desc4')->nullable();
            $table->integer('cobert')->default(1);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('territory_id')->references('id')->on('territories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
