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

        Schema::create('penyedia_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug');
            $table->string('tipe')->nullable();
            $table->boolean('aktif')->default(false);
            $table->BigInteger('biaya_tetap_sen')->default(0);
            $table->bigInteger('biaya_persen')->default(0);
            $table->text('konfigurasi_json');
            $table->string('webhook_url');
            $table->string('dashboard_url');

            $table->unique(['nama','slug']);
        });

        Schema::create('jenis_tagihan', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama');
            $table->string('deskripsi')->nullable();
            $table->bigInteger('nominal_sen')->nullable();
            $table->boolean('berulang')->default(false);
            $table->string('periode')->default(0);
            $table->string('jenjang')->nullable();

            $table->unique(['kode','nama']);
        });

        Schema::create('tagihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('jenis_tagihan_id');
            $table->unsignedBigInteger('semester_id');
            $table->date('jatuh_tempo')->nullable();
            $table->bigInteger('jumlah_sen')->default(0);
            $table->bigInteger('dibayar_sen')->default(0);
            $table->enum('jenis_soal', ['menunggu', 'dibayar','gagal','dikembalikan','dibatalkan']);

            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('set null');
            $table->foreign('jenis_tagian_id')->references('id')->on('jenis_tagihan')->onDelete('set null');
            $table->foreign('semester_id')->references('id')->on('semester')->onDelete('set null');
            $table->unique(['siswa_id','jenis_tagihan_id','semester']);
        });

        Schema::create('pembayaran_tagihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tagihan_id');
            $table->unsignedBigInteger('penyedia_id');
            $table->BigInteger('jumlah_sen');
            $table->string('kode_mata_uang');
             $table->enum('jenis_soal', ['menunggu', 'dibayar','gagal','dikembalikan','dibatalkan']);
            $table->bigInteger('jumlah_sen')->default(0);
            $table->bigInteger('dibayar_sen')->default(0);
            $table->enum('jenis_soal', ['menunggu', 'dibayar','gagal','dikembalikan','dibatalkan']);

            $table->foreign('jenis_tagian')->references('id')->on('tagihan')->onDelete('set null');
            $table->foreign('penyedia_id')->references('id')->on('penyedia_pembayaran')->onDelete('set null');
            $table->unique(['tagihan_id','penyedia_id']);
        });




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_tagihan');
        Schema::dropIfExists('tagihan');
        Schema::dropIfExists('jenis_tagihan');
        Schema::dropIfExists('penyedia_pembayaran');
    }
};
