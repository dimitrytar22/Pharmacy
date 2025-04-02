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
            $table->dropColumn('payment_method');
            $table->unsignedBigInteger('payment_method_id')->after('user_id')->nullable();
            $table->index('payment_method_id');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_payment_method_id_foreign');
            $table->dropIndex('orders_payment_method_id_index');
            $table->dropColumn('payment_method_id');
            $table->string('payment_method')->after('user_id')->nullable();
        });
    }
};
