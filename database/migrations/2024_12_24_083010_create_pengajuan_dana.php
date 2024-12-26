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
        Schema::create('pengajuan_dana', function (Blueprint $table) {
            $table->id();
            $table->string('subjek_pengajuan');
            $table->string('tujuan_pengajuan');
            $table->string('verifikasi_pimpinan')->default('pending');
            $table->string('verifikasi_bendahara')->default('pending');
            $table->string('keterangan_verifikasi_pimpinan')->nullable();
            $table->string('keterangan_verifikasi_bendahara')->nullable();
            $table->foreignId('id_user')->constrained('users', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_dana');
    }
};
