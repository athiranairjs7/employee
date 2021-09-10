<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('salutation');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('gender');
            $table->string('resume');
            $table->date('dateofjoining');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->string('city');
            $table->integer('pincode');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        //
    }
}
