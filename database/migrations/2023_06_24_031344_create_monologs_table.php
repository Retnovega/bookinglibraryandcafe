<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonologsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monologs', function (Blueprint $table) {
            $table->id();
            $table->integer('category');
            $table->string('foto');
            $table->string('judul');
            $table->string('tanggal');
            $table->string('deskripsi');
            $table->string('upload');
            $table->string('penulis');
            $table->string('status');
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
        Schema::dropIfExists('monologs');
    }
}
