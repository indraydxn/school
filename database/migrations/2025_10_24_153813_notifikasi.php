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
            $table->unsignedBigInteger('pengguna_id')->nullable();
            $table->string('tipe');
            $table->string('judul');
            $table->text('isi');
            $table->text('data_json');
            $table->boolean('sudah_dibaca')->default(false);
            $table->timestamp('dibaca_pada');

            $table->foreign('pengguna_id')->references('id')->on('user')->onDelete('set null');
            $table->unique(['pengampu_id','nama']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
