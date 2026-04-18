<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (config('default.subDivision')) {
            Schema::create('sub_division_document_categories', function (Blueprint $table) {
                $table->id();
                $table->softDeletes();
                $table->string('title');
                if (config('default.dual_language')) {
                    $table->string('title_en');
                }
                $table->foreignId('sub_division_id')->constrained()->cascadeOnDelete();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        if (config('default.subDivision')) {
            Schema::dropIfExists('sub_division_document_categories');
        }
    }
};
