<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitPenempatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_penempatan', function (Blueprint $table) {
            $table->id('id_unit_penempatan');
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('id_sekolah');
            $table->unsignedBigInteger('id_kategori');
            $table->unsignedBigInteger('id_sub_kategori');
            $table->string('kelas', 20);
            $table->string('jumlah_anak', 2);
            $table->string('detail', 100);
            $table->string('jumlah_pertemuan', 10);
            $table->date('mulai_tanggal');
            $table->date('sampai_tanggal');
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
        Schema::dropIfExists('unit_penempatan');
    }
}