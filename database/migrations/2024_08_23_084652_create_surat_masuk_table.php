<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
                $table->id('id_surat_masuk');
                $table->dateTime('tgl_surat_masuk');
                $table->unsignedBigInteger('id_instansi'); //asal surat
                $table->enum('sifat_surat', ['Formal', 'Bisnis', 'Resmi']);
                $table->string('perihal', 100);
                $table->string('tindak_lanjut', 100);
                $table->string('file_surat')->nullable();
                $table->string('catatan', 150)->nullable();
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
        Schema::dropIfExists('surat_masuk');
    }
}