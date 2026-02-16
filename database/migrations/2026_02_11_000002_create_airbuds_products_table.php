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
        Schema::create('airbuds_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('airbuds');
            $table->integer('price');
            $table->integer('orig_price')->nullable();
            $table->text('descri')->nullable();
            $table->json('images')->nullable(); // Array of image URLs
            $table->json('colors')->nullable(); // Array of color hex codes
            $table->integer('discount')->default(0);
            $table->string('gender')->nullable(); // men, women, or null for all
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airbuds_products');
    }
};
