<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('best', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['watch','headphone','airbud']);
            $table->integer('original_price');
            $table->integer('sale_price');
            $table->integer('discount');
            $table->decimal('rating', 2, 1);
            $table->integer('reviews');
            $table->string('image');
            $table->boolean('status')->default(1); // best seller on/off
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('best');
    }
};
