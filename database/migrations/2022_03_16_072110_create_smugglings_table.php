<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (config('default.smuggling')) {
            Schema::create('smugglings', function (Blueprint $table) {
                $table->id();
                if (config('default.dual_language')) {
                    $table->string('title_en');
                    $table->longText('description_en')->nullable();
                }
                $table->string('title');
                $table->longText('description')->nullable();
                if(config('default.subDivision')){
                    $table->foreignId('sub_division_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');

                }
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        if (config('default.smuggling')) {
            Schema::dropIfExists('smugglings');
        }
    }
};
