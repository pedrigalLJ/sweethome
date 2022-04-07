<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_id')->unsigned();
            $table->string('title');
            $table->enum('category', ['apartment','condo','house']);
            $table->enum('type', ['rent','sale']);
            $table->integer('bedroom');
            $table->integer('bathroom');
            $table->string('street_brgy');
            $table->string('city');
            $table->string('province');
            $table->string('featured_image')->nullable();
            $table->double('price');
            $table->boolean('status')->default(1)->nullable(); //1 available 0 not available
            $table->string('description');
            $table->string('avail_days');
            $table->string('avail_times');
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
        Schema::dropIfExists('properties');
    }
}
