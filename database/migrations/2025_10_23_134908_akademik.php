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
            $table->bigInteger('nomor_absen')->nullable();
            $table->string('status', 20)->default('aktif'); // sesuai DBML
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade'); // diperbaiki
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->unique(['kelas_id', 'siswa_id', 'semester_id'], 'ak_kelas_siswa_sem_unique'); // nama index pendek
        });

        Schema::create('mata_pelajaran', function (Blueprint $table) {
            $table->id();
            // sesuaikan dengan DBML: kode, nama, kelompok, kkm, jenjang (jenjang sebagai string/enum sesuai implementasi)
            $table->string('kode', 30)->unique();
            $table->string('nama', 120);
            $table->string('kelompok', 40)->nullable();
            $table->integer('kkm')->default(75);
            $table->string('jenjang')->nullable();
            // index unik pendek jika diperlukan, contoh hanya pada kode saja (kode sudah unique)
        });

        Schema::create('pengampu_mapel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('semester_id');
            $table->integer('jam_per_minggu')->default(2);
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('mata_pelajaran_id')->references('id')->on('mata_pelajaran')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('users')->onDelete('cascade'); // ke users sesuai DBML
            $table->foreign('semester_id')->references('id')->on('semester')->onDelete('cascade');
            // gunakan nama index yang singkat agar tidak melebihi batas MySQL
            $table->unique(['kelas_id','mata_pelajaran_id','semester_id'], 'pm_kelas_mapel_sem_unique');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengampu_mapel');
        Schema::dropIfExists('mata_pelajaran');
        Schema::dropIfExists('anggota_kelas');
        Schema::dropIfExists('kelas');
        Schema::dropIfExists('tingkat_kelas');
        Schema::dropIfExists('semester');
        Schema::dropIfExists('tahun_ajaran');
    }
};
 // ...existing code...
