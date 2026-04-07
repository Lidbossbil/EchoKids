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
        Schema::create('bai_hocs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('danh_muc_id')->constrained('danh_muc_bai_hocs')->onDelete('cascade');
            $table->foreignId('nguoi_tao_id')->constrained('nguoi_dungs')->onDelete('cascade');
            $table->string('tieu_de', 200);
            $table->text('mo_ta')->nullable();
            $table->string('cap_do', 20);
            $table->integer('thu_tu')->nullable();
            $table->integer('trang_thai')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bai_hocs');
    }
};
