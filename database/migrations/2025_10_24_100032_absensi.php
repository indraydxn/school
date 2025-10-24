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
        Schema::create('absensi_pertemuan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengampu_id');
            $table->date('tanggal');
            $table->BigInteger('pertemuan_ke');
            $table->string('topik');
            $table->foreign('pengampu_id')->references('id')->on('pengampu_mapel')->onDelete('cascade');
            $table->unique(['pengampu_id', 'judul','topik']);
        });

        Schema::create('absensi_pertemuan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('absensi_id');
            $table->unsignedBigInteger('siswa_id');
            $table->string('status', 20)->default('aktif');
            $table->timestamp('jam_masuk');
            $table->string('catatan');
            $table->foreign('absensi_id')->references('id')->on('absensi_pertemuan')->onDelete('cascade');
            $table->unique(['absensi_id', 'siswa_id','jam_masuk']);
        });





    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_pertemuan');
        Schema::dropIfExists('absensi_detail');

    }
};
