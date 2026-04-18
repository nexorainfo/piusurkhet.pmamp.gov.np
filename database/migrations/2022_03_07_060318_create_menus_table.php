<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('model');
            $table->foreignId('menu_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('title');
            if (config('default.dual_language')) {
                $table->string('title_en');
            }
            $table->integer('position');
            $table->boolean('status')->default(1);
            $table->string('type')->nullable();
            $table->string('slug');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
