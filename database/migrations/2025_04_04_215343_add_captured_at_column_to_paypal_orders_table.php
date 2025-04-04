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
            $table->dateTime('captured_at')->after('paypal_order_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paypal_orders', function (Blueprint $table) {
            if (Schema::hasColumn('paypal_orders', 'captured_at')) {
                $table->dropColumn('captured_at');
            }
        });
    }
};
