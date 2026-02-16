<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('best_sellers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('descri')->nullable();
            $table->decimal('orig_price', 10, 2);
            $table->decimal('sale_price', 10, 2);
            $table->integer('discount')->default(0);
            $table->enum('category', ['watches','headphones','airbuds']);
            $table->json('colors');
            $table->json('images');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('best_sellers');
    }
};
