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
        Schema::create('materi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengampu_id');
            $table->string('judul');
            $table->text('konten_text');
            $table->string('berkas_url');
            $table->foreign('pengampu_id')->references('id')->on('pengampu_mapel')->onDelete('cascade');
            $table->unique(['pengampu_id', 'judul']);
        });

        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengampu_id');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('lampiran_url');
            $table->timestamp('deadline');
            $table->bigInteger('skor_max');
            $table->foreign('pengampu_id')->references('id')->on('pengampu_mapel')->onDelete('cascade');
            $table->unique(['pengampu_id', 'judul']);
        });

        Schema::create('pengumpulan_tugas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tugas_id');
            $table->unsignedBigInteger('siswa_id');
            $table->text('jawaban_text');
            $table->timestamp('deadline');
            $table->bigInteger('skor_max');
            $table->text('umpan_balik');
            $table->foreign('tugas_id')->references('id')->on('tugas')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->unique(['tugas_id', 'siswa_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumpulan_tugas');
        Schema::dropIfExists('tugas');
        Schema::dropIfExists('materi');
    }
};
