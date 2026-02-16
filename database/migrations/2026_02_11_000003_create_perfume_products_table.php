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
        Schema::create('perfume_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('perfume');
            $table->integer('price');
            $table->integer('orig_price')->nullable();
            $table->text('descri')->nullable();
            $table->json('images')->nullable();
            $table->json('colors')->nullable();
            $table->integer('discount')->default(0);
            $table->string('gender')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfume_products');
    }
};
