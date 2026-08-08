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
        Schema::create('demographic_entries', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('kategori', ['penduduk', 'nelayan', 'pendapatan_nelayan', 'anggota_smc', 'pembudidaya_kerang_hijau']);
            $table->string('data_spesifik');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demographic_entries');
    }
};
