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
        Schema::create('vis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoi_dung_id')
                ->unique()
                ->constrained('nguoi_dungs')
                ->onDelete('cascade');
            $table->unsignedBigInteger('so_du')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vis');
    }
};
