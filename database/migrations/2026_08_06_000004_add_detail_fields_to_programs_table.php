php artisan migrate<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('nama');
            $table->string('gambar')->nullable()->after('icon');
            $table->longText('konten')->nullable()->after('gambar');
        });
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn(['slug', 'gambar', 'konten']);
        });
    }
};
