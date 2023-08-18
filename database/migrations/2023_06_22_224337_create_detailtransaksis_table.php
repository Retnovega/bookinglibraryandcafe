<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailtransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailtransaksis', function (Blueprint $table) {
            $table->id();
            $table->integer('idtransaksi');
            $table->integer('idreservasi');
            $table->integer('idmeja');
            $table->integer('idmenu');
            $table->integer('harga_awal');
            $table->float('diskon');
            $table->integer('harga_akhir');
            $table->integer('jumlah');
            $table->integer('total_harga');
            $table->string('status');
            $table->string('aksi');
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
        Schema::dropIfExists('detailtransaksis');
    }
}
