<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('cau_hinh_he_thongs')->insertOrIgnore([
            'ma_cau_hinh' => 'ti_le_hoa_hong_platform',
            'du_lieu' => json_encode(['phan_tram' => 20]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('cau_hinh_he_thongs')
            ->where('ma_cau_hinh', 'ti_le_hoa_hong_platform')
            ->delete();
    }
};
