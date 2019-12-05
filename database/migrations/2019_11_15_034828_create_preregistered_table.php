<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreregisteredTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preregistered', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('idnumber', 100);
            $table->string('firstname', 100)->nullable();
            $table->string('lastname', 100)->nullable();
            $table->tinyInteger('registered')->comment('0=false;1=true;')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preregistered');
    }
}
