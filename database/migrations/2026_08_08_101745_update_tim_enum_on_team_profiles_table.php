<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE team_profiles MODIFY tim ENUM('BPH','Penanggung Jawab','PPK Ormawa') NOT NULL DEFAULT 'BPH'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE team_profiles MODIFY tim ENUM('tim1','tim2','tim3') NOT NULL DEFAULT 'tim1'");
    }
};