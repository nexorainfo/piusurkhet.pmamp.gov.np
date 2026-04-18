<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('office_details', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->longText('description');
            if (config('default.dual_language')) {
                $table->string('title_en');
                $table->longText('description_en');
            }
            $table->boolean('show_on_index')->default(0);
            $table->enum('type', [config('types')])->nullable();
            $table->integer('position');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('office_details');
    }
};
