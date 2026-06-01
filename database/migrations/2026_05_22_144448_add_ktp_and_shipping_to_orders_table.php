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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('ktp_image_path')->nullable()->after('payment_bank');
            $table->decimal('shipping_distance', 8, 2)->nullable()->after('ktp_image_path');
            $table->decimal('shipping_cost', 12, 2)->nullable()->after('shipping_distance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['ktp_image_path', 'shipping_distance', 'shipping_cost']);
        });
    }
};
