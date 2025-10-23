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
        Schema::create('tahun_ajaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 20)->unique(); // sesuai DBML
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->boolean('aktif')->default(false);
        });

        Schema::create('semester', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->string('nama', 20);
            $table->enum('jenis', ['ganjil', 'genap']);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->boolean('aktif')->default(false);
            $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajaran')->onDelete('cascade');
            $table->unique(['tahun_ajaran_id', 'jenis']); // sesuai DBML
        });

        Schema::create('tingkat_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 20);
        });

        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->unsignedBigInteger('tingkat_id');
            $table->string('nama', 60);
            $table->string('kode', 30)->unique();
            $table->unsignedBigInteger('wali_kelas_id')->nullable(); // referensi ke users (nullable)
            $table->string('ruang', 30)->nullable();
            $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajaran')->onDelete('cascade');
            $table->foreign('tingkat_id')->references('id')->on('tingkat_kelas')->onDelete('cascade');
            // foreign key untuk wali_kelas_id bisa ditambahkan jika tabel users sudah ada pada migrasi sebelumnya
            $table->unique(['tahun_ajaran_id', 'tingkat_id', 'nama', 'kode']); // optional, sesuaikan kebutuhan
        });

        Schema::create('anggota_kelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('semester_id');
            $table->bigInteger('nomor_absen');
            $table->boolean('status')->default(false);
            $table->foreign('kelas_id')->references('id')->on('tingkat_kelas')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswa_id')->onDelete('siswa');
            $table->unique(['kelas_id', 'siswa_id', 'semester_id', 'nomor_absen']);
        });

        Schema::create('mata_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tingkat_kelas_id');
            $table->string('kode');
            $table->string('name', 60);
            $table->string('kelompok');
            $table->bigInteger('kkm');
            $table->foreign('tingkat_kelas_id')->references('id')->on('tingkat_kelas')->onDelete('cascade');
            $table->unique(['kode','tingkat_kelas_id', 'name', 'kelompok', 'kkm']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenjang');
        Schema::dropIfExists('mata_pelajaran');
        Schema::dropIfExists('kelas');
        Schema::dropIfExists('tingkat_kelas');
        Schema::dropIfExists('semester');
        Schema::dropIfExists('tahun_ajaran');
    }
};
 // ...existing code...
