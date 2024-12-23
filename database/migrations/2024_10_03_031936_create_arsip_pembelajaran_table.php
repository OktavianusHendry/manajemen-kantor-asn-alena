<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipPembelajaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arsip_pembelajaran', function (Blueprint $table) {
            $table->id('id_arsip_pembelajaran');
            $table->string('judul_pembelajaran', 150);
            $table->unsignedBigInteger('id_jenjang');
            $table->string('kelas', 50);
            $table->string('pertemuan_ke', 25);
            $table->unsignedBigInteger('id_kategori');
            $table->unsignedBigInteger('id_sub_kategori');
            $table->string('file_satu')->nullable();
            $table->string('file_dua')->nullable();
            $table->string('file_tiga')->nullable();
            $table->string('file_empat')->nullable();
            $table->string('file_lima')->nullable();
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('arsip_pembelajaran');
    }
}