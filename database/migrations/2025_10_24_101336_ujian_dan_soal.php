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
        Schema::create('bank_soal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengampu_id');
            $table->string('judul');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('pengampu_id')->references('id')->on('pengampu_mapel')->onDelete('cascade');
            $table->unique(['pengampu_id', 'judul']);
        });

        Schema::create('soal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bank_soal_id');
            $table->text('text');
            $table->enum('jenis_soal', ['pilihan_ganda', 'esai']);
            $table->unsignedInteger('skor_max')->default(0);
            $table->unsignedInteger('posisi')->default(0);
            $table->text('kunci_text')->nullable();
            $table->timestamps();

            $table->foreign('bank_soal_id')->references('id')->on('bank_soal')->onDelete('cascade');
            $table->unique(['bank_soal_id', 'text']);
        });

        Schema::create('opsi_soal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('soal_id');
            $table->text('opsi_text');
            $table->boolean('benar')->default(false);
            $table->unsignedInteger('posisi')->default(0);
            $table->timestamps();

            $table->foreign('soal_id')->references('id')->on('soal')->onDelete('cascade');
            $table->unique(['soal_id', 'opsi_text']);
        });

        Schema::create('ujian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bank_soal_id')->nullable();
            $table->enum('jenis',['ulangan_harian','kuis','tugas','uts','uas','ujian']);
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->timestamp('mulai_pada')->nullable();
            $table->timestamp('selesai_pada')->nullable();
            $table->unsignedInteger('durasi_menit')->default(0);
            $table->timestamps();

            $table->foreign('bank_soal_id')->references('id')->on('bank_soal')->onDelete('set null');
            $table->unique(['bank_soal_id','judul','jenis']);
        });

        Schema::create('ujian_peserta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ujian_id');
            $table->unsignedBigInteger('siswa_id');
            $table->boolean('status')->default(true);
            $table->timestamp('mulai_pada')->nullable();
            $table->timestamp('selesai_pada')->nullable();
            $table->bigInteger('skor_total')->default(0);
            $table->timestamps();

            $table->foreign('ujian_id')->references('id')->on('ujian')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->unique(['ujian_id','siswa_id']);
        });

        Schema::create('ujian_jawaban', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ujian_peserta_id');
            $table->unsignedBigInteger('soal_id');
            $table->unsignedBigInteger('opsi_terpilih_id')->nullable();
            $table->text('jawaban')->nullable();
            $table->boolean('benar')->default(false);
            $table->integer('skor_diperoleh')->default(0);
            $table->timestamps();

            $table->foreign('ujian_peserta_id')->references('id')->on('ujian_peserta')->onDelete('cascade');
            $table->foreign('soal_id')->references('id')->on('soal')->onDelete('cascade');
            $table->foreign('opsi_terpilih_id')->references('id')->on('opsi_soal')->onDelete('set null');
            $table->unique(['ujian_peserta_id','soal_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ujian_jawaban');
        Schema::dropIfExists('ujian_peserta');
        Schema::dropIfExists('ujian');
        Schema::dropIfExists('opsi_soal');
        Schema::dropIfExists('soal');
        Schema::dropIfExists('bank_soal');
    }
};
