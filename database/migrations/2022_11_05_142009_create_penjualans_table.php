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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('nota');
            $table->dateTime('tanggal_pembelian');
            $table->foreignId('pembayaran_id');
            $table->foreignId('alamat_id');
            $table->foreignId('kurir_id');
            $table->integer('qty');
            $table->integer('total');
            $table->enum('status_pengiriman', ['confirmed', 'rejected', 'pending']);
            $table->foreignId('user_id');
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
        Schema::dropIfExists('penjualans');
    }
};
