<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->foreignId('product_variant_id')
                ->nullable()
                ->after('id')
                ->constrained('product_variants')
                ->cascadeOnDelete();
        });

        DB::table('offers')
            ->where('id', 1)
            ->update([
                'product_variant_id' => 2,
            ]);

        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->foreignId('product_variant_id')
                ->nullable(false)
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->foreignId('product_id')
                ->nullable()
                ->after('id')
                ->constrained('products')
                ->cascadeOnDelete();
        });

        DB::table('offers')
            ->where('id', 1)
            ->update([
                'product_id' => 1,
            ]);

        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign(['product_variant_id']);
            $table->dropColumn('product_variant_id');
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->foreignId('product_id')
                ->nullable(false)
                ->change();
        });
    }
};
