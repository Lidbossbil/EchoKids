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
        Schema::create('don_nap_tiens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoi_dung_id')
                ->constrained('nguoi_dungs')
                ->onDelete('cascade');
            $table->string('ma_don', 50)->unique();
            $table->unsignedBigInteger('so_tien');
            $table->string('trang_thai', 20)->default('cho_xu_ly');
            $table->string('ma_giao_dich_vnpay', 50)->nullable();
            $table->string('ngan_hang_vnpay', 20)->nullable();
            $table->text('du_lieu_callback')->nullable();
            $table->timestamp('ngay_tao')->useCurrent();
            $table->timestamp('ngay_cap_nhat')->useCurrent()->useCurrentOnUpdate();

            $table->index('nguoi_dung_id');
            $table->index('trang_thai');
            $table->index('ngay_tao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_nap_tiens');
    }
};
