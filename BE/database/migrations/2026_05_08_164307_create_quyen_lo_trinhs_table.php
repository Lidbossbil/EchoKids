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
        Schema::create('quyen_lo_trinhs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hoc_vien_id')
                ->constrained('nguoi_dungs')
                ->onDelete('cascade');
            $table->foreignId('lo_trinh_id')
                ->constrained('lo_trinh_ca_nhans')
                ->onDelete('cascade');
            $table->unsignedBigInteger('gia_da_mua');
            $table->decimal('ti_le_hoa_hong_da_ap', 5, 2);
            $table->unsignedBigInteger('so_tien_giao_vien_nhan');
            $table->timestamp('ngay_mua')->useCurrent();
            $table->unique(['hoc_vien_id', 'lo_trinh_id']);

            $table->index('hoc_vien_id');
            $table->index('lo_trinh_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quyen_lo_trinhs');
    }
};
