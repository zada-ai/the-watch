<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('watchespage', function (Blueprint $table) {
            $table->id();

            // Basic info
            $table->string('name');
            $table->string('category')->default('watches');
            $table->boolean('active')->default(true);

            // Prices
            $table->integer('orig_price')->default(0);
            $table->integer('sale_price')->default(0);
            $table->integer('discount')->default(0);

            // Description
            $table->text('descri')->nullable();

            // Images & Colors (JSON)
            $table->json('images')->nullable(); 
            /*
              Example:
              {
                "black": ["img1.jpg","img2.jpg"],
                "silver": ["img3.jpg"]
              }
            */

            $table->json('colors')->nullable();
            /*
              Example:
              {
                "black": "#000000",
                "silver": "#c0c0c0"
              }
            */

            // Gender filter (future use)
            $table->enum('gender', ['men', 'women', 'unisex'])->default('men');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('watchespage');
    }
};
