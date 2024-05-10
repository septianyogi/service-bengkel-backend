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
        Schema::create('orderitems', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('user_id');
            $table->string('alamat');
            $table->string('tanggal');
            $table->string('status');
            $table->string('pembayaran');
            $table->unsignedBigInteger('sparepart_id');
            $table->integer('jumlah');
            $table->integer('harga');
            $table->integer('total_harga');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('orders');
            $table->foreign('sparepart_id')->references('id')->on('spareparts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderitems');
    }
};
