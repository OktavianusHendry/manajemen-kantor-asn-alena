<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanCutiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_cuti', function (Blueprint $table) {
            $table->id('cuti_id');
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('id_divisi');
            $table->unsignedBigInteger('id_jenis_cuti');
            $table->date('mulai_tanggal');
            $table->date('sampai_tanggal');
            $table->text('keterangan')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->string('catatan')->nullable();
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
        Schema::dropIfExists('laporan_cuti');
    }
}