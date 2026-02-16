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
        Schema::create('buy_videos', function (Blueprint $table) {
            $table->id();
            $table->string('product_type');
            $table->unsignedBigInteger('product_id');
            $table->string('video_path');
            $table->timestamps();

            $table->index(['product_type', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buy_videos');
    }
};
