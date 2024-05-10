<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('serviceitems', function (Blueprint $table) {
            $table->id('service_id');
            $table->unsignedBigInteger('user_id');
            $table->string('tanggal');
            $table->string('status');
            $table->boolean('home_pickup');
            $table->string('no_polisi');
            $table->string('mobil');
            $table->string('jenis_service');
            $table->string('keluhan')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->timestamps();

            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serviceitems');
    }
};
