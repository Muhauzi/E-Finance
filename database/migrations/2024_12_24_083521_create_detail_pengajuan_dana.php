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
        Schema::create('detail_pengajuan_dana', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_dana_id')->constrained('pengajuan_dana', 'id');
            $table->string('item');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->integer('harga_satuan');
            $table->integer('total_harga');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengajuan_dana');
    }
};
