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
        Schema::table('nguoi_dungs', function (Blueprint $table) {
            $table->string('ten_ngan_hang', 100)->nullable()->after('hash_reset');
            $table->string('so_tai_khoan', 30)->nullable()->after('ten_ngan_hang');
            $table->string('chu_tai_khoan', 100)->nullable()->after('so_tai_khoan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nguoi_dungs', function (Blueprint $table) {
            $table->dropColumn(['ten_ngan_hang', 'so_tai_khoan', 'chu_tai_khoan']);
        });
    }
};
