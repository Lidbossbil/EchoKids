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
        Schema::create('yeu_cau_rut_tiens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('giao_vien_id')
                ->constrained('nguoi_dungs')
                ->onDelete('cascade');
            $table->unsignedBigInteger('so_tien');
            $table->string('ten_ngan_hang_snapshot', 100);
            $table->string('so_tai_khoan_snapshot', 30);
            $table->string('chu_tai_khoan_snapshot', 100);
            $table->string('trang_thai', 20)->default('cho_duyet');
            $table->text('ly_do_tu_choi')->nullable();
            $table->foreignId('admin_xu_ly_id')
                ->nullable()
                ->constrained('nguoi_dungs')
                ->onDelete('set null');
            $table->timestamp('ngay_xu_ly')->nullable();
            $table->timestamp('ngay_tao')->useCurrent();
            $table->timestamps();

            $table->index('giao_vien_id');
            $table->index('trang_thai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yeu_cau_rut_tiens');
    }
};
