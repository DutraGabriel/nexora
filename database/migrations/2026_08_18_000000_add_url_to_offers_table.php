<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->string('url', 2048)->nullable()->after('is_active');
        });

        DB::table('offers')
            ->whereNull('url')
            ->orderBy('id')
            ->get(['id'])
            ->each(function (object $offer): void {
                DB::table('offers')
                    ->where('id', $offer->id)
                    ->update(['url' => "https://example.com/offers/{$offer->id}"]);
            });
    }

    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('url');
        });
    }
};