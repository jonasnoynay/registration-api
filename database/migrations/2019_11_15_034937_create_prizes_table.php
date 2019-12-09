<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('prizes', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('name', 200)->nullable();
        //     $table->integer('available')->default(0)->nullable();
        //     $table->string('won')->default(0)->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prizes');
    }
}
