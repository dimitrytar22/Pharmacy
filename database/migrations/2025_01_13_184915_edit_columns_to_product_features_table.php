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
        Schema::table('product_features', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('description');

            $table->unsignedBigInteger('feature_id')->nullable()->after('product_id');
            $table->index('feature_id');
            $table->foreign('feature_id')->references('id')->on('features');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_features', function (Blueprint $table) {
            $table->dropForeign('product_features_feature_id_foreign');
            $table->dropIndex('product_features_feature_id_index');
            $table->dropColumn('feature_id');

            $table->string('title')->after('product_id');
            $table->string('description')->after('title');
        });
    }
};
