<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id('id_surat_keluar');
            $table->dateTime('tgl_surat_keluar');
            $table->unsignedBigInteger('id_instansi'); //asal surat
            $table->unsignedBigInteger('id'); //pengirim surat keluar
            $table->unsignedBigInteger('id_tujuan'); //tujuan surat ditunjukkan
            $table->enum('sifat_surat_keluar', ['Formal', 'Bisnis', 'Resmi']);
            $table->string('perihal_surat', 100);
            $table->string('tindak_lanjut', 100);
            $table->string('file_surat')->nullable();
            $table->enum('status_surat', ['Pending', 'Approved', 'Rejected']);
            $table->string('catatan_surat', 150)->nullable();
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
        Schema::dropIfExists('surat_keluar');
    }
}