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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('no_ktp');
            $table->string('nama_lengkap');
            $table->string('no_bpjs_ketenaga_kerja');
            $table->longText('alamat_tempat_tinggal');
            $table->text('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('no_telepon');
            $table->string('agama');
            $table->string('jenis_kelamin');
            $table->string('status_pernikahan');
            $table->string('jenjang_pendidikan');
            $table->string('jabatan_kerja');
            $table->integer('gaji');
            $table->date('tanggal_masuk_kerja');
            $table->string('status_kerja');
            $table->string('status_aktif');
            $table->text('foto')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('users_id')->nullable();
            $table->timestamps();

            $table->foreign('users_id')->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
