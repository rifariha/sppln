<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('front_degree')->nullable();
            $table->string('back_degree')->nullable();
            $table->string('nik');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->enum('gender',['L','P']);
            $table->string('ktp_number');
            $table->text('address');
            $table->string('phone');
            $table->string('phone_alt')->nullable();
            $table->string('photo');
            $table->integer('position_id');
            $table->integer('user_id');
            $table->integer('dpc_id');
            $table->integer('dpd_id');
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
        Schema::dropIfExists('employee');
    }
}
