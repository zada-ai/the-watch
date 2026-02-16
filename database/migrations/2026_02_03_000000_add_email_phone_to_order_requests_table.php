<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_requests', function (Blueprint $table) {
            // Add email and phone columns if they don't exist
            if (!Schema::hasColumn('order_requests', 'email')) {
                $table->string('email')->nullable();
            }
            if (!Schema::hasColumn('order_requests', 'phone')) {
                $table->string('phone')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('order_requests', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone']);
        });
    }
};
