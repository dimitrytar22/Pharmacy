<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('paypal_orders', function (Blueprint $table) {
            $table->string('payment_link')->after('paypal_order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paypal_orders', function (Blueprint $table) {
            if (Schema::hasColumn('paypal_orders', 'payment_link')) {
                $table->dropColumn('payment_link');
            }
        });
    }
};
