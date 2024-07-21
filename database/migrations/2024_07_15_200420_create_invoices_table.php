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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('saba_id')->nullable();
            $table->string('nama_tagihan')->nullable();
            $table->string('jenis_tagihan')->nullable();
            $table->string('nominal_tagihan')->nullable();
            $table->string('tahun_ajaran')->nullable();
            $table->string('bulan_ajaran')->nullable();
            $table->string('status_tagihan')->default('Belum Lunas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
