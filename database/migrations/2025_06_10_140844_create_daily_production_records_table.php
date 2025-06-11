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
        Schema::create('daily_production_records', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('umur_ayam');
            $table->integer('populasi');
            $table->integer('mati');
            $table->integer('afkir');
            $table->integer('total_mati_afkir')->nullable(); // otomatis
            $table->float('pakan_kg');
            $table->integer('telur_butir');
            $table->float('telur_kg');
            $table->integer('telur_retak');
            $table->integer('telur_kotor');
            $table->float('hd_percent')->nullable(); // otomatis
            $table->float('hh_percent')->nullable(); // otomatis
            $table->float('fcr')->nullable(); // otomatis
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_production_records');
    }
};
