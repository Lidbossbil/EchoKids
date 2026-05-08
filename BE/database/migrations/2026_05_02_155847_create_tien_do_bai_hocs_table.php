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
        Schema::create('tien_do_bai_hocs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hoc_vien_id')->constrained('nguoi_dungs')->onDelete('cascade');
            $table->foreignId('bai_hoc_id')->constrained('bai_hocs')->onDelete('cascade');
            $table->integer('so_tu_da_hoc')->default(0);
            $table->decimal('phan_tram_hoan_thanh', 5, 2)->default(0);
            $table->integer('trang_thai')->default(0); // 0: Đang học, 1: Hoàn thành
            $table->decimal('diem_trung_binh', 4, 2)->default(0);
            $table->timestamp('thoi_gian_hoc_cuoi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tien_do_bai_hocs');
    }
};
