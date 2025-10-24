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
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->boolean('publik')->default(false);
            $table->timestamp('terbit_pada')->nullable();

            $table->unique(['judul']);
        });

        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('lokasi');
            $table->timestamp('mulai_pada');
            $table->timestamp('selesai_pada');
            $table->text('deskriopsi');

            $table->unique(['judul','mulai_pada','selesai_pada']);
        });

        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('gambar_url');
            $table->text('deskriopsi');
            $table->timestamp('terbit_pada');

            $table->unique(['judul','terbit_pada']);
        });

        Schema::create('halaman', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('judul');
            $table->text('kontent_text');
            $table->enum('jenis_soal', ['draf', 'terbit','arsip']);
            $table->timestamp('terbit_pada');


            $table->unique(['slug','judul','terbit_pada']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('halaman');
        Schema::dropIfExists('galeri');
        Schema::dropIfExists('agenda');
        Schema::dropIfExists('pengumuman');
    }
};
