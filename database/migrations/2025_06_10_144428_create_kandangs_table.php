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
       Schema::create('kandangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // misal: Kandang A, Kandang B
            $table->integer('populasi_awal')->nullable(); // opsional
            $table->date('tanggal_mulai')->nullable(); // tanggal ayam masuk
            $table->integer('umur_awal')->default(0);   // umur ayam saat masuk (misal: DOC = 1)
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kandangs');
    }
};
