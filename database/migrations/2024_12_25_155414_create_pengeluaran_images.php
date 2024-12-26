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
        Schema::create('pengeluaran_images', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('detail_pengeluaran_id') // Foreign key
                  ->constrained('detail_pengeluaran', 'id') // References 'id' on 'detail_pengeluaran' table
                  ->onDelete('cascade'); // Cascade on delete
            $table->text('image_path'); // Path to the image
            $table->timestamps(); // 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaran_images');
    }
};
