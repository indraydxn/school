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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengampu_id');
            $table->date('tanggal');
            $table->unsignedBigInteger('pertemuan_ke');
            $table->string('topik');
            $table->foreign('pengampu_id')->references('id')->on('pengampu_mapel')->onDelete('cascade');
            $table->unique(['pengampu_id', 'judul']);
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
