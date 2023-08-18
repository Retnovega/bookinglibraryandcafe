<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->integer('idcustomer');
            $table->string('kodereservasi');
            $table->string('tanggal');
            $table->string('jam');
            $table->string('jumlah');
            $table->string('status');
            $table->string('no_meja');
            $table->string('massage');
            $table->string('pembayaran');
            $table->string('buktibayar');
            $table->string('bank');
            $table->string('pemilik');
            $table->string('jumlahbayar');
            $table->string('biayalain');
            $table->integer('keperluanid');
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
        Schema::dropIfExists('reservasis');
    }
}
