<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Office hours and social links shown in the public footer.
 * Each column is only added if it's missing, so this is safe on databases changed by hand.
 */
return new class extends Migration
{
    private const COLUMNS = [
        'office_hours_winter',
        'office_hours_summer',
        'youtube_url',
        'instagram_url',
        'tiktok_url',
    ];

    public function up(): void
    {
        foreach (self::COLUMNS as $column) {
            if (!Schema::hasColumn('office_settings', $column)) {
                Schema::table('office_settings', function (Blueprint $table) use ($column) {
                    $table->string($column)->nullable();
                });
            }
        }
    }

    public function down(): void
    {
        foreach (self::COLUMNS as $column) {
            if (Schema::hasColumn('office_settings', $column)) {
                Schema::table('office_settings', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
