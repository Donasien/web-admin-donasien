<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('fullname');
            $table->string('gender');
            $table->string('kk');
            $table->string('phone');
            $table->string('address');
            $table->string('title');
            $table->string('target_amount');
            $table->string('latest_amount')->nullable();
            $table->string('end_date');
            $table->string('description');
            $table->string('cover_photo');
            $table->string('ktp_photo');
            $table->string('medical_photo');
            $table->string('disease_photo');
            $table->string('house_photo');
            $table->string('status')->nullable();
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
};
