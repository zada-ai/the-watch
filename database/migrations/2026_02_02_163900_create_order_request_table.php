<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_requests', function (Blueprint $table) {
            $table->id();
            $table->string('contact_type'); // email or phone
            $table->string('contact_value'); // email address or phone number
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_requests');
    }
};
