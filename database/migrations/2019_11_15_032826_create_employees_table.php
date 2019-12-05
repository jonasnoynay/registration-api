<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('idnumber', 100);
            $table->string('firstname', 100)->nullable();
            $table->string('lastname', 100)->nullable();
            $table->date('hiredate')->nullable();
            $table->date('regdate')->nullable();
            $table->string('empstatus', 50)->nullable();
            $table->string('cellnumber', 50)->nullable();
            $table->string('emailaddress', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
