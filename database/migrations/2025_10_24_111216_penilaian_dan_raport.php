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
         Schema::create('komponen_nilai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengampu_id')->nullable();
            $table->string('nama');
            $table->bigInteger('bobot_persen')->nullable();

            $table->foreign('pengampu_id')->references('id')->on('pengampu_mapel')->onDelete('set null');
            $table->unique(['pengampu_id','nama']);
        });

        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('komponen_id')->nullable();
            $table->unsignedInteger('siswa_id');
            $table->bigInteger('skor');
            $table->string('catatan');

            $table->foreign('komponen_id')->references('id')->on('pengampu_id')->onDelete('set null');
            $table->unique(['komponen_id','siswa_id','skor','catatan']);
        });

        Schema::create('raport_hitam', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('raport_id')->nullable();
            $table->unsignedInteger('pengampu_id');
            $table->bigInteger('nilai_akhir');
            $table->string('predikat');
            $table->text('deskripsi');

            $table->foreign('raport_id')->references('id')->on('nilai')->onDelete('set null');
            $table->unique(['raport_id','pengampu_id','nilai_akhir','predikat',"deskrpsi"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raport_hitam');
        Schema::dropIfExists('nilai');
        Schema::dropIfExists('komponen_nilai');
    }
};
