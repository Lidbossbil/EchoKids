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
        Schema::create('goi_y_luyen_taps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('giao_vien_id')->constrained('nguoi_dungs')->onDelete('cascade');
            $table->foreignId('hoc_vien_id')->constrained('nguoi_dungs')->onDelete('cascade');
            $table->text('noi_dung');
            $table->integer('da_doc')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goi_y_luyen_taps');
    }
};
