<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('product_type')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('product_name')->nullable();
            $table->decimal('unit_price', 12, 2)->default(0);
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 12, 2)->default(0);
            $table->decimal('orig_price', 12, 2)->nullable();
            $table->json('selected_colors')->nullable();
            $table->json('selected_color_qtys')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_sub')->nullable();
            $table->string('payment_txn_id')->nullable();
            $table->string('payment_proof_path')->nullable();
            $table->string('ship_name')->nullable();
            $table->text('ship_address')->nullable();
            $table->string('ship_city')->nullable();
            $table->string('ship_nearby')->nullable();
            $table->string('ship_postal')->nullable();
            $table->string('ship_country')->nullable();
            $table->string('buyer_email')->nullable();
            $table->string('buyer_phone')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
