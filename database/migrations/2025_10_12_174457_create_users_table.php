<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik')->unique();
            $table->bigInteger('no_kk')->nullable();
            $table->string('nama_lengkap', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('foto_url', 255)->nullable();
            $table->string('telepon', 30)->nullable();
            $table->string('tempat_lahir', 120);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');
            $table->boolean('status')->default(true);
            $table->timestamp('login_terakhir')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['nik', 'email', 'telepon']);
        });

        Schema::create('user_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->unique(['user_id', 'role_id']);
        });

        Schema::create('staf', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->bigInteger('no_staf')->unique();
            $table->bigInteger('nip')->unique()->nullable();
            $table->bigInteger('nuptk')->unique()->nullable();
            $table->integer('tahun_masuk');
            $table->enum('status_kepegawaian', ['PNS', 'NON-PNS']);
            $table->string('pendidikan_terakhir', 100);
            $table->string('jabatan', 40);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['user_id', 'no_staf', 'nip', 'nuptk']);
        });

        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->bigInteger('nis')->unique();
            $table->bigInteger('nisn')->unique();
            $table->bigInteger('tahun_masuk');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['user_id', 'nis', 'nisn']);
        });

        Schema::create('wali_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('student_id');
            $table->string('hubungan', 120);
            $table->string('pendidikan_terakhir', 120);
            $table->string('pekerjaan', 120);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('siswa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wali_siswa');
        Schema::dropIfExists('siswa');
        Schema::dropIfExists('staf');
        Schema::dropIfExists('user_has_roles');
        Schema::dropIfExists('users');
    }
};
