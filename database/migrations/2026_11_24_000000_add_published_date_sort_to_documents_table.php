<?php

use App\Support\BsDateSortKey;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('documents', 'published_date_sort')) {
            Schema::table('documents', function (Blueprint $table) {
                // Zero-padded copy of published_date ("2083-02-06") used only for sorting.
                $table->string('published_date_sort', 10)->nullable()->after('published_date');
                $table->index(['status', 'published_date_sort']);
            });
        }

        // Safe to repeat: recomputes the sort key from the date as typed.

        DB::table('documents')->select('id', 'published_date')->orderBy('id')
            ->chunkById(500, function ($documents) {
                foreach ($documents as $document) {
                    DB::table('documents')->where('id', $document->id)->update([
                        'published_date_sort' => BsDateSortKey::from($document->published_date),
                    ]);
                }
            });
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropIndex(['status', 'published_date_sort']);
            $table->dropColumn('published_date_sort');
        });
    }
};
