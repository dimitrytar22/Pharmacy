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
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('instruction');
            $table->index('category_id');
            $table->foreign('category_id')->on('categories')->references('id');

            $table->string('image')->nullable()->after('count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image');

            $table->dropForeign('products_category_id_foreign');
            $table->dropIndex('products_category_id_index');
            $table->dropColumn('category_id');
        });
    }
};
